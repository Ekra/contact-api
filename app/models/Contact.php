<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/3/15
 * Time: 4:24 PM
 */

class Contact extends Eloquent{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'contacts';



    public $timestamps = false;

    protected $fillable = ['first_name','last_name','email','address','twitter'];

    public function user()
    {
        return $this->belongsTo('User');
    }

} 