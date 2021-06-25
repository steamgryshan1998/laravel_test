<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Request;
//use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'slug','title', 'excerpt', 'body']; // $guard - не позволяет менять значение выбранного поля в свободном порядке, fillable - позволяет
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
/*class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () { // function for caching
            return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                ))
                ->sortByDesc('date');
        });
    }


    public static function find($slug) {
        //of all the blog posts, find one with a slug matches the on that was requested.
        $post = static::all()->firstWhere('slug',$slug);

        if (! $post) {
           throw new ModelNotFoundException();
        }
        /*base_path();

        if(! file_exists($path = resource_path("/posts/{$slug}.html"))){
        /*        dd('File does not exists!'); // debugging
                abort(404);  */
            //return redirect('/');
        /*    throw new ModelNotFoundException();
        }

        return cache() -> remember("posts.{$slug}",5, function() use ($path){
            var_dump('file_get_contents');   // these code uses for caching
            return file_get_contents($path);
        });*/
/*        return $post;
    }
/*
