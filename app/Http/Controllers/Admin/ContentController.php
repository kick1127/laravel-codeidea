<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Content;
use App\Models\ContentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ContentController extends Controller
{
    private $table;

    private function setTable(string $table)
    {
        $this->table = env('BOARD_TABLE_PREFIX').$table;
    }

    public function index(Request $request, string $table)
    {
        $this->setTable($table);
        $board = view()->shared('board');

        $category = $request->get('category', '') ?: '';

        $contents = Content::fromTable($this->table);

        $builder = getSearchBuilder($request, $contents, ['top_fix', 'id']);
        if (gettype($builder) === 'string') {
            return back()->withErrors($builder)->withInput($request->input());
        }
        $contents = $builder['builder'];
        $search   = $builder['search'];

        # Category search
        if (!empty($category)) {
            $contents->where('category', $category);
        }

        $contents = $contents->paginate($board->itemCountPerPage);

        $search = array_merge($search, ['category' => $category]);

        $contents->appends($search);

        return view('admin.content.list', [
            'title'       => '게시글관리 - '.$board->name,
            'currentMenu' => $table,
            'data'        => $contents,
            'search'      => json_encode($search),
        ]);
    }

    public function create(string $table)
    {
        $board = view()->shared('board');

        return view('admin.content.form', [
            'title'       => '게시글관리 - '.$board->name,
            'currentMenu' => $table,
        ]);
    }

    public function store(Request $request, string $table)
    {
        $this->setTable($table);

        $topFix   = $request->post('top_fix', false);
        $title    = $request->post('title', '');
        $author   = $request->post('author', '');
        $text     = $request->post('content', '');
        $category = $request->post('category', '');
        $files    = $request->post('files', '');

        if (empty($title)) {
            return back()->withErrors('제목을 입력해 주세요.')->withInput($request->input());
        }
        if (empty($text)) {
            return back()->withErrors('내용을 입력해 주세요.')->withInput($request->input());
        }

        $content = new Content();
        $content->setTable($this->table);
        $content->topFix   = $topFix;
        $content->title    = $title;
        $content->author   = $author;
        $content->content  = $text;
        $content->category = $category;
        $content->userId   = $request->user()->id;
        $content->save();

        if (!empty($files)) {
            $files = json_decode($files);
            foreach ($files as $file) {
                $f = new ContentFile();
                $f->setTable($this->table.'_file');
                $f->originalName = $file->original_name;
                $f->filename     = $file->filename;
                $f->mimeType     = $file->mime_type;
                $f->size         = $file->size;
                $f->contentId    = $content->id;
                $f->save();
            }
        }

        return redirect(route('admin.board.content.index', $table));
    }

    public function show(string $table, int $id)
    {
        $this->setTable($table);
        $board   = view()->shared('board');
        $content = Content::fromTable($this->table)->where('id', $id)->first();

        return view('admin.content.view', [
            'title'       => '게시글관리 - '.$board->name,
            'currentMenu' => $table,
            'data'        => $content,
        ]);
    }

    public function edit(string $table, $id)
    {
        $this->setTable($table);
        $board   = view()->shared('board');
        $content = Content::fromTable($this->table)->where('id', $id)->first();
        $files   = json_encode($content->files());

        return view('admin.content.form', [
            'title'       => '게시글관리 - '.$board->name,
            'currentMenu' => $table,
            'data'        => $content,
            'files'       => $files,
        ]);
    }

    public function update(Request $request, string $table, int $id)
    {
        $this->setTable($table);

        $topFix   = $request->post('top_fix', false);
        $title    = $request->post('title', '');
        $author   = $request->post('author', '');
        $text     = $request->post('content', '');
        $category = $request->post('category', '');
        $files    = $request->post('files', '');

        if (empty($title)) {
            return back()->withErrors('제목을 입력해 주세요.')->withInput($request->input());
        }
        if (empty($text)) {
            return back()->withErrors('내용을 입력해 주세요.')->withInput($request->input());
        }

        $content = Content::fromTable($this->table)->where('id', $id)->first();
        $content->setTable($this->table);
        $content->topFix   = $topFix;
        $content->title    = $title;
        $content->author   = $author;
        $content->content  = $text;
        $content->category = $category;
        $content->save();

        foreach ($content->files() as $file) {
            $file->delete();
        }

        if (!empty($files)) {
            $files = json_decode($files);
            foreach ($files as $file) {
                $f = new ContentFile();
                $f->setTable($this->table.'_file');
                $f->originalName = $file->original_name;
                $f->filename     = $file->filename;
                $f->mimeType     = $file->mime_type;
                $f->size         = $file->size;
                $f->contentId    = $content->id;
                $f->save();
            }
        }

        return redirect(route('admin.board.content.show', [$table, $id]));
    }

    public function destroy(string $table, $id)
    {
        $this->setTable($table);
        $content = Content::fromTable($this->table)->where('id', $id)->first();
        foreach ($content->files() as $file) {
            $file->delete();
        }
        $content->delete();

        return redirect(route('admin.board.content.index', $table));
    }
}
