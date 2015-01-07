<?php



class BaseNotes extends Eloquent
{
    protected $fillable = ['id_author','id_cours','token'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basenotes';

    private $id_autor;
    private $id_cours;
    private $token;
    private $id;


    /**
     * Return the children manuscrit without check its existence
     * @return Manuscrit : children or null
     */
    public function getManuscrit()
    {
        return Manuscrit::find($this->id);
    }

    /**
     * return the children file without check its existence
     * @return Manuscrit : children or null
     */
    public function getFile()
    {
        return Files::find($this->id);
    }

    /**
     * Return the primary key unique ID
     * @return Integer : unique ID
     */
    public function getID()
    {
        return $this->attributes['id'];
    }

    /**
     * Gives the parent course unique ID
     * @return Integer : course unique ID
     */
    public function getParentCourseID()
    {
        return $this->attributes['id_cours'];
    }

    /**
     * Gives the parent course unique ID
     * @return Integer : course unique ID
     */
    public function getParentCourse()
    {
        return Course::find($this->attributes['id_cours']);
    }

    /**
     * Static function that generate a random token of 32 chars using open SSL
     * @return string : token
     */
    public static function getNewToken()
    {
        return openssl_random_pseudo_bytes(32);
    }

}
