<?php 

namespace OrlandoLibardi\TagCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Lang;
use Log;

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
        
        $this->setTag(json_decode($request->tags));

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
    public function destroy(TagRequest $request, $id) {
        
        $this->tagDestroy(json_decode($request->id));         
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
        //return Lang::get($this->getFileName());
        return File::getRequire($this->getFileName());
    }
    /**
     * setTag
     */
    public function setTag($tags)
    {        
        $linha = "\r\n";
        $content = '<?php' . $linha;
        $content .= '/*'. $linha;
        $content .= '|--------------------------------------------------------------------------' . $linha;
        $content .= '| OlCms Tags Lines '. $linha;
        $content .= '|--------------------------------------------------------------------------'. $linha;
        $content .= '*/'. $linha;
        $content .= $linha;
        $content .= 'return [' . $linha;

        foreach($tags as $key=>$value)
        {
            $value = str_replace('"', '', $value);
            $value = str_replace("'", "", $value);
            $content .= "'" . $key ."' => '" . $value . "', " . $linha;
        }

        $content .= '];'. $linha;

        return $this->tagSaveFile($content);

    }
    /**
     * destroy tag
     */
    public function tagDestroy($keys, $tags=false)
    {
        if(!$tags) $tags = $this->getTag();

        foreach($keys as $key)
        {
            if(array_key_exists($key, $tags))
            {
                unset($tags[$key]);
            }
        }
        $this->setTag($tags);
    }
    /**
     * save file
     */
    public function tagSaveFile($content)
    {
        return File::put($this->getFileName(), $content);
    }
   
    /**
     * get file name
     */
    public function getFileName()
    {
        return resource_path('lang\\en\\') . 'informacoes.php' ;
    }

    
}