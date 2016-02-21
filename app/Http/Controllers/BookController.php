<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Http\Requests;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Jobs\BookFormFields;
use App\Picture;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'category', 'search']]);
    }

    public function index()
    {
        $books = Book::paginate(12);
        $data = [];
        $data['books'] = $books;
        $data['categories'] = Category::all();
        $data['category_id'] = -1;
        return view('book.index')->with($data);
    }

    public function create()
    {
        $data = $this->dispatch(new BookFormFields());
        return view('book.create')->with($data);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('book.book')->with("book", $book);
    }

    public function category($id)
    {
        $data = array();
        $data['books'] = Category::findOrFail($id)->books()->paginate(12);
        $data['categories'] = Category::all();
        $data['category_id'] = $id;
        return view('book.index')->with($data);
    }

    public function listPic()
    {
        FileController::listPic();
        echo 'list';
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        if (!$key) {
            return back()->withInput()->withErrors('关键字不能为空');
        }
        $data = array();
        $data['books'] = Book::where("name", 'like', '%' . $key . '%')->paginate(12);
        return view('book.search')->with($data);
    }


    public function store(BookCreateRequest $request)
    {
        $file = $request->file('pictures');
        if (!$file->isValid()) {
            return back()->withInput()->withErrors('图片上传失败');
        }
        $user = $request->user();
        $book = Book::create($request->bookFillData());
        $book->syncCategories($request->get('categories', []));


        $finalName = $user->stu_num . '_' . time() . '_' . $file->getClientOriginalName();
        $content = File::get($file->getRealPath());

        $disk = Storage::disk('qiniu');

        if ($disk->put($finalName, $content)) {
            $url = $disk->getDriver()->downloadUrl($finalName);
            $picture = new Picture();
            $picture->url = $url;
            $book->pictures()->save($picture);
        } else {
            $book->categories()->detach();
            $book->delete();
            return back()->withInput()->withErrors('图片上传失败');
        }

        $user->books()->save($book);

        return redirect('/')->withSuccess('发布成功');
    }

    public function edit($book_id)
    {
        $book = Book::findOrFail($book_id);

        if (Gate::denies('update.book', $book)) {
            abort(403);
        }

        $data = $this->dispatch(new BookFormFields($book));

        return view('book.edit', $data);
    }

    /**
     * Update the Post
     *
     * @param BookUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BookUpdateRequest $request, $book_id)
    {
        if (Gate::denies('update.book', Book::findOrFail($book_id))) {
            abort(403);
        }

        $post = Book::findOrFail($book_id);
        $post->fill($request->bookFillData());
        $post->save();
        $post->syncCategories($request->get('categories', []));

        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->withSuccess('Book saved.');
        }

        return redirect('/')
            ->withSuccess('Book saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if (Gate::denies('update.book', $book))
        {
            abort(403);
        }

        $book->categories()->detach();
        $book->delete();

        if ($book->trashed())
        {
            return redirect('/')
                ->withSuccess('成功删除书 ' . $book->name);
        }
        return back()
            ->withErrors('删除 ' . $book->name . ' 失败.');
    }

}
