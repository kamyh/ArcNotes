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

    //attributes
    private $id_basenotes;
    private $title;
    private $content;


    /**
     * return the parent Basenote's id cause Manuscrit inherit from Basenote
     * @return Integer : The parent ID
     */
    public function getParent()
    {
        return BaseNotes::find($this->attributes['id_basenotes']);
    }

    /**
     * Return the title
     * @return String : The manuscrit'stTitle
     */
    public function getTitle()
    {
        return $this->attributes['title'];
    }

    /**
     * @return String: The manuscrit's content
     */
    public function getContent()
    {
        return $this->attributes['content'];
    }
}
