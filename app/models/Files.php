<?php



class Files extends Eloquent
{
    protected $fillable = ['path'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    private $id_basenote;


    public function getParent()
    {
        return BaseNotes::find($this->$id_basenote);
    }


}
