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

    private $id_basenote;


    public function getParent()
    {
        return BaseNotes::find($this->$id_basenote);
    }


}
