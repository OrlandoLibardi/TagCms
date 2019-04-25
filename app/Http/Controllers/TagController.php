<?php 

namespace OrlandoLibardi\TagCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use OrlandoLibardi\TagCms\app\Http\Requests\TagRequest;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list');
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update', 'status']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);                
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {  
     
     $tags = $this->getTag();
     return view('admin.tag.index', compact('tags'));      
        
    }    
    /**
     * Store a newly created resource in file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request) {
        
        $tags = $this->getTag();

        $this->setTag($tags, $request->all());

        return response()
        ->json(array(
            'message' => __('messages.create_success'),
            'status'  =>  'success'
        ), 200);
    }    

    /**
     * Remove the specified resource from file.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuRequest $request, $id) {
        
        foreach(json_decode($request->tag_name) as $item)
        {
           $this->tagDestroy($item);          
        }
        
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }
    /**
     * getTag
     */
    public function getTag()
    {

    }
    /**
     * getTag
     */
    public function setTag($old, $new)
    {

    }
    /**
     * destroy tag
     */
    public function tagDestroy($selected)
    {

    }
    /**
     * save file
     */
    public function tagSaveFile($file, $content)
    {

    }
    /**
     * open file
     */
    public function tagOpenFile()
    {

    }
    /**
     * get file name
     */
    public function getFileName()
    {

    }

    
}