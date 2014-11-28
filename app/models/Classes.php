<?php



class Classes extends Eloquent
{
    protected $fillable = ['name','id_school','scollaryear','degree','domain','previous','visibility'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

<<<<<<< HEAD


}
=======
    public function getCourses()
    {
        return DB::table('assocclasscourse')->where('id_class','=',$this->id)->get();
    }
}
>>>>>>> 69a74acd73235c7a89693f4f54b26d3222115e50
