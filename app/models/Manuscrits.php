<?php



class Manuscrits extends Eloquent
{
    protected $fillable = ['id_basenotes','content','title'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manuscrits';

    private $id_basenotes;
    private $title;
    private $content;


    public function getParent()
    {
        return BaseNotes::find($this->attributes['id_basenotes']);
    }

    public function getTitle()
    {
        return $this->attributes['title'];
    }

    public function getContent()
    {
        return $this->attributes['content'];
    }


}
