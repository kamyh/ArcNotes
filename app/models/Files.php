<?php


class Files extends Eloquent
{
    protected $fillable = ['id_basenotes', 'path', 'original_filename', 'mime'];

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


    /**
     * return the parent basenote id
     * @return Integer : the parent's basenote ID
     */
    public function getParent()
    {
        return BaseNotes::find($this->attributes['id_basenotes']);
    }

    /**
     * Give the path to the file
     * @return String : the path to the physic file
     */
    public function getPath()
    {
        return $this->attributes['path'];
    }

    /**
     * Give the original filename of file
     * @return String : filename
     */
    public function getOriginalName()
    {
        return $this->attributes['original_filename'];
    }

    /**
     * Give the filesize with unity (B,KB,MB, etc)
     * @return string : filesize and unity
     */
    public function getSize()
    {
        $fullpath = public_path() . $this->attributes['path'];
        if (is_file($fullpath)) {
            $bytesSize = filesize(public_path() . $this->attributes['path']);
            $kilo = 1024;

            if ($bytesSize < $kilo) {
                return $bytesSize . 'B';
            } else if ($bytesSize < $kilo * $kilo) {
                return ceil($bytesSize / $kilo) . 'kB';
            } else if ($bytesSize < $kilo * $kilo * $kilo) {
                return ceil($bytesSize / ($kilo * $kilo)) . 'MB';
            } else {
                return ceil($bytesSize / ($kilo * $kilo * $kilo)) . 'GB';
            }
        } else {
            return 'undefined size';
        }
    }

    /**
     * Return the Mime type string for http request header
     * @return string : MIME type string
     */
    public function getMIMEType()
    {
        return 'Content-Type: ' . $this->attributes['mime'];
    }
}