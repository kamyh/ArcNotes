<?php



class Files extends Eloquent
{
    protected $fillable = ['id_basenotes','path','original_filename','mime'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    private $id_basenotes;
    private $original_filename;
    private $path;
    private $mime;


    public function getParent()
    {
        return BaseNotes::find($this->attributes['id_basenotes']);
    }

    public function getPath()
    {
        return $this->attributes['path'];
    }

    public function getOriginalName()
    {
        return $this->attributes['original_filename'];
    }

    public function getSize()
    {
        if(is_file($this->attributes['path']))
        {
            $bytesSize = filesize(public_path().$this->attributes['path']);
            $kilo = 1024;

            if($bytesSize < $kilo) {
                return $bytesSize . 'B';
            }
            else if($bytesSize < $kilo*$kilo) {
                return ceil($bytesSize / $kilo) .'kB';
            }
            else if($bytesSize < $kilo*$kilo*$kilo) {
                return ceil($bytesSize / ($kilo * $kilo)) . 'MB';
            }
            else {
                return ceil($bytesSize / ($kilo * $kilo * $kilo)) . 'GB';
            }
        }
        else
        {
            return 'undefined size';
        }
    }

    public function getMIMEType()
    {
        return 'Content-Type: '.$this->attributes['mime'];
    }
}
