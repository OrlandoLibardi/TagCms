<?php 

namespace OrlandoLibardi\TagCms\app\Providers;
use Illuminate\Support\ServiceProvider;



class OlCmsTagServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Rotas para controllador Tag
         */
        Route::namespace('OrlandoLibardi\TagCms\app\Http\Controllers')
               ->middleware(['web', 'auth'])
               ->prefix('admin')
               ->group(__DIR__. '/../../routes/web.php');
        /**
         * Publicar os arquivos 
         */
        $this->publishes( [
            __DIR__.'/../../database/seeds/' => database_path('seeds/'),
            __DIR__.'/../../resources/lang/en/' => resource_path('resources/lang/en/'),
            __DIR__.'/../../resources/lang/pt-br/' => resource_path('resources/lang/pt-br/'),             
        ],'config');  
        
    }
    
}