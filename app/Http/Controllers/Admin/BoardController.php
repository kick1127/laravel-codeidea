<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $boards = Board::join('users', 'boards.user_id', 'users.id')
                       ->select(['boards.*', 'users.username']);

        $builder = getSearchBuilder($request, $boards, ['id'], ['register' => 'users.username']);
        if (gettype($builder) === 'string') {
            return back()->withErrors($builder)->withInput($request->input());
        }
        $boards = $builder['builder'];
        $search = $builder['search'];

        $boards = $boards->paginate(10);
        $boards->appends($search);

        return view('admin.board.list', [
            'title'       => '게시판관리',
            'currentMenu' => 'board',
            'data'        => $boards,
            'search'      => json_encode($search),
        ]);
    }

    public function create()
    {
        return view('admin.board.form', [
            'title'       => '게시판관리',
            'currentMenu' => 'board',
        ]);
    }

    public function store(Request $request)
    {
        $name             = $request->post('name', '');
        $tableName        = $request->post('table_name', '');
        $itemCountPerPage = $request->post('item_count_per_page', '');
        $category         = $request->post('category', '');

        if (empty($name)) {
            return back()->withErrors('게시판 이름을 입력해주세요.')->withInput($request->input());
        }
        if (empty($tableName)) {
            return back()->withErrors('테이블 이름을 입력해주세요.')->withInput($request->input());
        }
        if (empty($itemCountPerPage)) {
            return back()->withErrors('페이지 당 컨텐츠 수를 입력해주세요.')->withInput($request->input());
        }

        if (!validateTableName($tableName)) {
            return back()->withErrors('유효하지 않은 테이블 이름입니다.')->withInput($request->input());
        }

        $board                   = new Board();
        $board->name             = $name;
        $board->tableName        = $tableName;
        $board->itemCountPerPage = $itemCountPerPage;
        $board->category         = $category;
        $board->userId           = $request->user()->id;

        if (!$this->createTable('default', $board->tableName)) {
            return back()->withErrors('테이블 생성에 실패하였습니다.')->withInput($request->input());
        }

        $board->save();

        return redirect(route('admin.board.show', $board->id));
    }

    public function show($id)
    {
        $board = Board::find($id);

        return view('admin.board.form', [
            'title'       => '게시판관리',
            'currentMenu' => 'board',
            'data'        => $board,
        ]);
    }

    public function edit(Request $request, $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $name             = $request->post('name', '');
        $itemCountPerPage = $request->post('item_count_per_page', '');
        $category         = $request->post('category', '');

        if (empty($name)) {
            return back()->withErrors('게시판 이름을 입력해주세요.')->withInput($request->input());
        }
        if (empty($itemCountPerPage)) {
            return back()->withErrors('페이지 당 컨텐츠 수를 입력해주세요.')->withInput($request->input());
        }

        $board                   = Board::find($id);
        $board->name             = $name;
        $board->itemCountPerPage = $itemCountPerPage;
        $board->category         = $category;
        $board->save();

        return redirect(route('admin.board.show', $board->id));
    }

    public function destroy($id)
    {
        Board::find($id)->delete();

        return redirect(route('admin.board.index'));
    }

    private function createTable(string $type, string $tableName): bool
    {
        $tableName = env('BOARD_TABLE_PREFIX').$tableName;

        if (Schema::hasTable($tableName)) {
            return false;
        }

        $result = false;

        switch ($type) {
            case 'default':
                $result = $this->createDefaultBoardTable($tableName);
                break;
        }

        return $result;
    }

    private function createDefaultBoardTable(string $tableName): bool
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained();
            $table->string('author')->nullable()->comment('Author');
            $table->string('title')->nullable()->comment('Title');
            $table->longText('content')->nullable()->comment('Content');
            $table->boolean('top_fix')->default(false)->comment('Top fix');
            $table->string('category')->nullable()->comment('Category');
        });

        Schema::create($tableName.'_file', function (Blueprint $table) use ($tableName) {
            $table->id();
            $table->timestamps();

            $table->string('original_name')->comment('Original filename');
            $table->string('filename')->comment('Saved filename');
            $table->string('mime_type')->comment('Mime type');
            $table->string('size')->comment('Size');

            $table->foreignId('content_id')->constrained($tableName);
        });

        return true;
    }
}
