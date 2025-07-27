<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\Like;
use App\Models\User;
use App\Models\View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{

    #region Function yang digunakan untuk halaman Utama

    public function index(){
        $allDiscussions = Discussion::with(['user', 'likes', 'comments', 'views', 'category'])->withCount(['likes', 'comments', 'views'])->latest()->paginate(4);
        $user = auth()->user();

        // Menghitung Total Seluruh diskusi berdasarkan kategori
        $allCategories = Category::all();
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');

        // Replace diskusi yang telah di like / dislike
        $allDiscussions->setCollection(
            $allDiscussions->getCollection()->transform(function ($discussion) {
                $discussion->is_liked = $discussion->likes->contains('user_id', auth()->id());
                return $discussion;
            })
        );

        return view('index', [
            'allDiscussions' => $allDiscussions,
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts,
            'user' => $user
        ]);
    }

    #endregion

    #region Function yang digunakan untuk halaman Buat Diskusi Baru

    public function buatDiskusiBaru(){
        // Prerequisites
        $allCategories = Category::all();
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');
        $user = auth()->user();

        return view('page.buat_diskusi_baru', [
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts,
            'user' => $user
        ]);
    }

    public function buatDiskusiBaruProcess(){
        $validate = request()->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
        ],[
            'judul.required' => 'Judul diskusi tidak boleh kosong.',
            'kategori.required' => 'Kategori diskusi tidak boleh kosong.',
            'deskripsi.required' => 'Deskripsi diskusi tidak boleh kosong.',
            'judul.max' => 'Judul diskusi maksimal 255 karakter.',
        ]);

        $category_id = Category::where('kategori', $validate['kategori'])->firstOrFail()->id;

        $data = [
            'judul' => $validate['judul'],
            'deskripsi' => $validate['deskripsi'],
            'user_id' => auth()->id(),
            'category_id' => $category_id
        ];

        Discussion::create($data);

        return redirect('/buat-diskusi-baru')->with('success', 'Diskusi baru berhasil dibuat!');

    }

    #endregion

    #region Function yang digunakan untuk halaman Detail Diskusi

    public function detailDiskusi($id){
        // Prerequisites
        $allCategories = Category::all();
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');
        $user = auth()->user();

        // Functionality
        $decoded = Hashids::decode($id);

        $discussion = Discussion::with(['user', 'likes', 'comments', 'views', 'category'])->withCount('likes', 'views', 'comments')->where('id', $decoded[0])->firstOrFail();

        $discussion->is_liked = $discussion->likes->contains('user_id', auth()->id());

        // Cek Sort Comment
        $sortby = request()->input('sortby');

        if($sortby == 'lattest'){
            // lattest
            $allComments = $discussion->comments()->with('user', 'likes')->withCount('likes')->latest()->get();
        
        } else if ($sortby == 'mostlikes'){
            // most likes
            $allComments = $discussion->comments()->with('user', 'likes')->withCount('likes')->orderBy('likes_count', 'desc')->get();
        
        } else{

            $allComments = $discussion->comments()->with('user', 'likes')->withCount('likes')->latest()->get();
        }

        $allComments->transform(function ($comment) {
            $comment->is_liked = $comment->likes->contains('user_id', auth()->id());
            return $comment;
        });

        // Cek apakah user sudah pernah view discussion ini
        $alreadyViewed = $discussion->views()
        ->where('user_id', auth()->id())
        ->exists();

        if (! $alreadyViewed) {
            $discussion->views()->create([
                'user_id' => auth()->id(),
            ]);
            $discussion->views_count++;
        }

        return view('page.detail_diskusi',[
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts,
            'discussion' => $discussion,
            'allComments' => $allComments,
            'user' => $user
        ]);
    }

    public function editDiskusi($id){
        // Prerequisites
        $allCategories = Category::all();
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');
        $user = auth()->user();

        $decoded = Hashids::decode($id);

        $discussion = Discussion::with('user', 'category')->where('id', $decoded[0])->first();

        return view('page.edit_diskusi', [
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts,
            'discussion' => $discussion,
            'user' => $user
        ]);
    }

    public function editDiskusiProcess(){

        $discussion_id = request()->input('discussion_id');
        $discussion = Discussion::with('category')->where('id', $discussion_id)->first();

        $oldData = [
            'judul' => $discussion->judul,
            'kategori' => $discussion->category->kategori,
            'deskripsi' => $discussion->deskripsi
        ];

        $newData = [
            'judul' => request()->input('judul'),
            'kategori' => request()->input('kategori'),
            'deskripsi' => request()->input('deskripsi')
        ];

        if($oldData === $newData){
            return redirect()->back();

        } else{
            $validate = request()->validate([
                'judul' => 'required|string|max:255',
                'kategori' => 'required|string',
                'deskripsi' => 'required|string',
            ],[
                'judul.required' => 'Judul diskusi tidak boleh kosong.',
                'kategori.required' => 'Kategori diskusi tidak boleh kosong.',
                'deskripsi.required' => 'Deskripsi diskusi tidak boleh kosong.',
                'judul.max' => 'Judul diskusi maksimal 255 karakter.',
            ]);

            $category_id = Category::where('kategori', $validate['kategori'])->firstOrFail()->id;

            $data = [
                'judul' => $validate['judul'],
                'category_id' => $category_id,
                'deskripsi' => $validate['deskripsi']
            ];

            Discussion::where('id', $discussion_id)->update($data);

            return redirect()->back()->with('success', 'Diskusi berhasil diedit!');
        }
    }

    public function deleteDiskusiProcess(){
        $dicussion_id = request()->input('discussion_id');

        Discussion::where('id', $dicussion_id)->delete();

        return redirect('/')->with('success', 'Diskusi berhasil dihapus!');
    }

    public function komentarProcess(){

        $discussion = Discussion::findOrFail(request()->input('discussion_id'));

        $discussion->comments()->create([
            'komentar' => request()->input('komentar'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    #endregion

    #region Function global untuk search dan like

    public function searchProcess(){
        // Prerequisites
        $allCategories = Category::all();
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');

        $user = auth()->user();

        $search = request()->input('search');

        $kategori = request()->input('kategori');

        if($kategori){
            $category_id = Category::where('kategori', $kategori)->firstOrFail()->id;
        }

        $populer = request()->input('populer');

        $query = Discussion::with(['user', 'likes', 'comments', 'views'])->withCount(['likes', 'comments', 'views']);

        // Search
        if($search) {
            $query->where('judul', 'LIKE', '%' . $search . '%');
        }
        
        // Kategori
        if($kategori) {
            $query->where('category_id', $category_id);
        }

        // Populer
        if ($populer === 'views') {
            $query->orderBy('views_count', 'desc');
        } elseif ($populer === 'likes') {
            $query->orderBy('likes_count', 'desc');
        } elseif ($populer === 'comments') {
            $query->orderBy('comments_count', 'desc');
        } else {
            $query->latest();
        }

        $allDiscussions = $query->paginate(4)
                                ->appends(request()->only(['search', 'kategori', 'populer']));

        $allDiscussions->setCollection(
            $allDiscussions->getCollection()->transform(function ($discussion) {
                $discussion->is_liked = $discussion->likes->contains('user_id', auth()->id());
                return $discussion;
            })
        );

        return view('index', [
            'allDiscussions' => $allDiscussions,
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts,
            'search' => $search,
            'kategori' => $kategori,
            'populer' => $populer,
            'user' => $user
        ]);
    }

    public function likeProcess(){

        $type = request()->input('type');
        $user_id = auth()->id();
        $likeable = null;

        if($type === 'comment'){

            $comment_id = request()->input('comment_id');
            $likeable = Comment::findOrFail($comment_id);

        } else if($type === 'discussion'){
            $discussion_id = request()->input('discussion_id');
            $likeable = Discussion::findOrFail($discussion_id);

        } else{
            abort(400, 'Invalid like tpye.');
        }

        // Cek apakah user sudah like

        $existingLike = $likeable->likes()->where('user_id', $user_id)->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            $likeable->likes()->create([
                'user_id' => $user_id,
            ]);
        }

        return Redirect::back();

    }

    #endregion

    #region Function yang digunakan untuk halaman Profile

    public function profile(){
        $user_id = auth()->id();

        $user = User::findOrFail($user_id);

        return view('page.profile', [
            'user' => $user
        ]);
    }

    public function profileProcess(){

        $oldNama = request()->input('nama');
        $user = auth()->user();

        if($user->nama === $oldNama && !request()->hasFile('pp')){
            return redirect()->back();

        } else{
            $data = request()->validate([
                'pp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'nama' => 'required|string|max:255',
            ],[
                'pp.image' => 'File yang diunggah harus berupa gambar.',
                'pp.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'pp.max' => 'Ukuran gambar maksmial 5 MB',
                'nama.required' => 'Nama tidak boleh kosong.',
                'nama.max' => 'Nama maksimal 255 karakter.',
            ]);

            $user->nama = $data['nama'];

            if(request()->hasFile('pp')){
                $image = request()->file('pp');

                $filename = time() . '_' . $image->getClientOriginalName();

                if($user->pp && file_exists(public_path($user->pp))){
                    unlink(public_path($user->pp));
                }

                $image->move(public_path('profile_photos'), $filename);

                $user->pp = 'profile_photos/' . $filename;
            }

            $user->save();

            return redirect()->back()->with('success', 'Profil berhasil diperbaharui!');
        }
    }

    #endregion

    #region Function yang digunakan untuk halaman Dashboard

    public static function dashboard(){
        $user = auth()->user();

        $totalDiscussions = $user->discussions()->count();

        $totalLikesDiscussions = Like::whereHasMorph(
        'likeable',
        [Discussion::class],
        fn($q) => $q->where('user_id', $user->id)
        )->where('user_id', '!=', $user->id)
        ->count();

        $totalLikesComments = Like::whereHasMorph(
        'likeable',
        [Comment::class],
        fn($q) => $q->where('user_id', $user->id)
        )->where('user_id', '!=', $user->id)
        ->count();

        $totalComments = Comment::whereHasMorph(
            'commentable',
            [Discussion::class],
            fn($q) => $q->where('user_id', $user->id)
        )->where('user_id', '!=', $user->id)
        ->count();

        $totalCommentsUnique = Comment::whereHasMorph(
            'commentable',
            [Discussion::class],
            fn($q) => $q->where('user_id', $user->id)
        )->where('user_id', '!=', $user->id)
        ->distinct('user_id')
        ->count();

        $totalViews = View::whereHasMorph(
            'viewable',
            [Discussion::class],
            fn($q) => $q->where('user_id', $user->id)
        )->where('user_id', '!=', $user->id)
        ->count();

        return view('page.dashboard', [
            'user' => $user,
            'totalDiscussions' => $totalDiscussions,
            'totalLikesDiscussions' => $totalLikesDiscussions,
            'totalLikesComments' => $totalLikesComments,
            'totalComments' => $totalComments,
            'totalCommentsUnique' => $totalCommentsUnique,
            'totalViews' => $totalViews,
        ]);
    }

    #endregion

    #region Function yang digunakan untuk halaman Manage Users
    
    public static function users(){
        $user = auth()->user();
        $allUsers = User::where('role', '!=', 'admin')->paginate(5);


        return view('page.manage_users', [
            'user' => $user,
            'allUsers' => $allUsers
        ]);
    }

    public static function usersActivateDeactivate(){
        $user_id = request()->input('user_id');

        $user = User::findOrFail($user_id);

        if($user->status){
            $user->status = 0;
        } else {
            $user->status = 1;
        }

        $user->save();

        return redirect()->back()->with('success', 'Status user berhasil diubah!');
    }

    #endregion

    #region Function yang digunakan untuk halaman Manage Categories

    public static function categories(){
        $user = auth()->user();

        $allCategories = Category::paginate(5);
        $discussionCounts = Category::withCount('discussions')->pluck('discussions_count', 'kategori');

        return view('page.manage_categories', [
            'user' => $user,
            'allCategories' => $allCategories,
            'discussionCounts' => $discussionCounts
        ]);
    }

    public static function buatKategori(){
        $user = auth()->user();

        return view('page.buat_kategori',[
            'user' => $user
        ]);
    }

    public static function buatKategoriProcess(){
        $validate = request()->validate([
            'kategori' => 'required|string|max:255|unique:categories,kategori',
        ],[
            'kategori.required' => 'Kategori tidak boleh kosong.',
            'kategori.max' => 'Kategori maksimal 255 karakter.',
            'kategori.unique' => 'Kategori sudah ada, silahkan gunakan kategori lain.'
        ]);

        $data = [
            'kategori' => $validate['kategori']
        ];

        Category::create($data);

        return redirect()->back()->with('success', 'Kategori baru berhasil dibuat!');
    }

    public static function editCategory($id){
        $user = auth()->user();

        $decoded = Hashids::decode($id);

        $allCategories = Category::all();
        $category = Category::where('id', $decoded[0])->firstOrFail();

        return view('page.edit_category', [
            'user' => $user,
            'allCategories' => $allCategories,
            'category' => $category
        ]);
    }

    public static function editCategoryProcess(){
        
        $oldKategori = request()->input('kategori');

        $category_id = request()->input('category_id');

        $category = Category::findOrFail($category_id);

        if($category->kategori === $oldKategori){
            return redirect()->back();
            
        } else {
            
            $validate = request()->validate([
                'kategori' => 'required|string|max:255|unique:categories,kategori'
            ]);
    
            $data = [
                'kategori' => $validate['kategori']
            ];
    
            $category->update($data);

        }

        return redirect()->back()->with('success', 'Kategori berhasil diperbaharui!');
    }

    public static function deleteCategoryProcess(){
        $category_id = request()->input('category_id');

        Category::where('id', $category_id)->delete();

        return redirect('/categories')->with('success', 'Kategori berhasil dihapus!');
    }

    #endregion

}
