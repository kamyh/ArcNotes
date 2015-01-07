<?php



class Canton extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cantons';


    public function getList()
    {
        return DB::table('cantons')->lists('name','id');
    }

}
