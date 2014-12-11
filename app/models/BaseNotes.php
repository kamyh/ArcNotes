<?php



class BaseNotes extends Eloquent
{
    protected $fillable = ['id_author','id_cours','name','token'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basenotes';

    private $id_autor;
    private $id_cours;
    private $name;
    private $token;


    public function getManuscrit()
    {
        return DB::table('manuscrits')->where('id_basenote','=',$this->id);
    }

    public function getFile()
    {
        return DB::table('files')->where('id_basenote','=',$this->id);
    }

    public function getID()
    {
        return $this->attributes['id'];
    }

    public function getParentCourseID()
    {
        return $this->attributes['id_cours'];
    }

    public static function getNewToken()
    {
        return openssl_random_pseudo_bytes(32);
    }

}
