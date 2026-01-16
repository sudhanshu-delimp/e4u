<?php

namespace App\Repositories\MassageProfile;

use App\Repositories\BaseRepository;
use App\Models\MassageMedia;

class MassageMediaRepository extends BaseRepository implements MassageMediaInterface
{
    protected $media;

    public function __construct(MassageMedia $media)
    {
        $this->model = $media;

      
    }

    public function findByPath($path)
    {
        return $this->model->where('path', $path)->first();
    }

    public function markDefault($media)
    {
        $medias = $this->model
            ->where('id', '!=', $media->id)
            ->where('massage_id', $media->massage_id)
            ->get();

        foreach ($medias as $other_media) {
            $other_media->default = 0;
            $other_media->save();
        }

        $media->default = 1;
        
        return $media->save();
    }
    public function updateOrCreate(array $input, $massage_id,$position)
	{
        $result = $this->model->where('user_id',$massage_id)
                        ->where('position',$position)
                        ->first();
        $id = null;
        if($result) { $id = $result->id; }
                    //    dd($id);
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}
    public function findByUid($user_id)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->get();
                        //dd($result);
		return $result;
	}
    public function nullPosition($user_id,$position)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->where('position', $position)
            ->first();
            if($result) {
                return $result->update(['position'=> null,'default'=>null]);
            }
            
            //return $result;
	}
    public function images($user_id)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->whereNotNull('position')
            ->get();
            return $result;
	}
    public function get_user_row($user_id)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->get();
            return $result;
	}

    // public function findByposition($user_id,$position,$type = NUll)
	// {
    //     $arr = [];
    //     if($position == 1) {
    //         if($image = $this->model->where('user_id',$user_id)->where('position', 1)->first()) {
    //             $arr = ['path'=>$image->path, 'id'=>$image->id];

    //             dd($arr);
    //             return $arr;
    //         } else {
                
    //             $arr = ['path'=>url('assets/app/img/img-11.png'), 'id'=>''];
    //             return $arr;
    //             //asset('assets/app/img/service-provider/Frame-408.png')
    //         }
            
    //     } elseif ($position == 8) {
    //         if($image = $this->model->where('user_id',$user_id)->where('position', 8)->first()) {
    //             $arr = ['path'=>$image->path, 'id'=>$image->id];
    //             return $arr;
    //         } else {
                
    //             $arr = ['path'=>url('assets/app/img/img-13.png'), 'id'=>''];
    //             return $arr;
    //         }
    //     } elseif ($position == 9) {
    //         if($image = $this->model->where('user_id',$user_id)->where('position', 9)->first()) {
    //             $arr = ['path'=>$image->path, 'id'=>$image->id];
    //             return $arr;
    //         } else {
                
    //             $arr = ['path'=>url('assets/app/img/img-13.png'), 'id'=>''];
    //             return $arr;
    //         }
    //     }  
    //     else {
    //         if($image = $this->model->where('user_id',$user_id)->where('position',$position)->first()) {
    //             $arr = ['path'=>$image->path, 'id'=>$image->id];
    //             return $arr;
    //         } else {
                
    //             $arr = ['path'=>url('assets/app/img/img-12.png'), 'id'=>''];
    //             return $arr;
    //         }
    //     }
        
    //                     //dd($result);$path->findByposition(auth()->user()->id,1
	// 	return $result;
	// }



    public function findByposition($user_id, $position, $type = null)
    {
        if ($position == 1) {

            $image = $this->model
                ->where('user_id', $user_id)
                ->where('position', 1)
                ->when(!is_null($type), function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->first();

            return $image
                ? ['path' => $image->path, 'id' => $image->id]
                : ['path' => url('assets/app/img/img-11.png'), 'id' => ''];

        } elseif ($position == 8) {

            $image = $this->model
                ->where('user_id', $user_id)
                ->where('position', 8)
                ->when(!is_null($type), function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->first();

            return $image
                ? ['path' => $image->path, 'id' => $image->id]
                : ['path' => url('assets/app/img/img-13.png'), 'id' => ''];

        } elseif ($position == 9) {
            $image = $this->model
                ->where('user_id', $user_id)
                ->where('position', 9)
                ->where('default', 1)
                ->when(!is_null($type), function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->first();

            return $image
                ? ['path' => $image->path, 'id' => $image->id]
                : ['path' => url('assets/app/img/img-13.png'), 'id' => ''];

        } else {

            $image = $this->model
                ->where('user_id', $user_id)
                ->where('position', $position)
                ->when(!is_null($type), function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->first();

            return $image
                ? ['path' => $image->path, 'id' => $image->id]
                : ['path' => url('assets/app/img/img-12.png'), 'id' => ''];
        }
    }


    ########## Gallery Methods #############

    public function with_Or_withoutPosition($user_id,$position = null)
    {
    
        $result = $this->model
            ->where('user_id',$user_id)
      
            ->where('type','=', 0)
            ->where('template','0');
        if($position) {
            $result = $result->where(function($q) use ($position) {
                $q
                    ->orWhereNull('position')
                    ->orWhereNotIn('position', $position);
            });
        }
        
        return $result->get();
    }
}
