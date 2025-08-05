<?php

namespace App\Repositories\Escort;

use App\Repositories\BaseRepository;
use App\Models\EscortMedia;

class EscortMediaRepository extends BaseRepository implements EscortMediaInterface
{
    protected $media;

    public function __construct(EscortMedia $media)
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
            ->where('escort_id', $media->escort_id)
            ->get();

        foreach ($medias as $other_media) {
            $other_media->default = 0;
            $other_media->save();
        }

        $media->default = 1;

        return $media->save();
    }
    public function get_user_row($user_id, $excludePosition = NULL)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->where('type','=',0);

        if($excludePosition) {
            if(is_array($excludePosition)) {
                $result = $result
                    ->orWhereNull('position')
                    ->whereNotIn('position', $excludePosition);
            } else {
                $result = $result
                    ->orWhereNull('position')
                    ->where('position','!=',$excludePosition);
            }
        }
        $result = $result->get();

        return $result;
	}
    public function get_videos($user_id)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->where('type','=',1)
            ->get();
            return $result;
	}
    public function findDefaultMedia($user_id, $mediaType = 0)
    {
        $result = $this->model
            ->where('user_id',$user_id)
            ->where('type','=', $mediaType)
            ->where('default','=', 1)
            ->where(function($q) {
                $q
                    ->orWhere('position','!=',8)
                    ->orWhere('position', null);
            })
            ->orderBy('position','ASC')
            ->get();

        return $result;
    }
    public function with_Or_withoutPosition($user_id,$position = null)
    {
//        dd($user_id);
        $result = $this->model
            ->where('user_id',$user_id)
//            ->where('position', null)
            ->where('type','=', 0);
            /*->where(function($q) {
                $q
                    ->orWhere('position','!=',9)
                    ->orWhere('position','!=',8)
                    ->orWhere('position', null);
            })*/


            //->orderBy('position','DESC')
        if($position) {
            $result = $result->where(function($q) use ($position) {
                $q
                    ->orWhereNull('position')
                    ->orWhereNotIn('position', $position);
            });
        }
        // if($position == null) {
        //     $result =   $result->whereNull('position')
        //     ->get();
        // }
        // if($position != null) {

        //     $result = $result->whereNotNull('position')
        //     ->where('position','!=', 8)
        //     ->orderBy('position','asc')
        //     ->get();

        // }

        return $result->get();
    }
    public function nullPosition($user_id,$position)
	{
	    $conditions = [
	        ['user_id', $user_id],
            ['position', $position],
            ['type', 0]
        ];
        if(in_array($position,[9,10])) {
            $update = ['default'=> 0];
            $conditions[] = ['default', 1];
        } else {
            $update = ['default'=> null];
            $update['position'] = null;
        }
        $result = $this->model
            ->where($conditions)
            ->first();
            if($result) {
                return $result->update($update);
            }

            //return $result;
	}
    public function nullVedioPosition($user_id,$position)
	{
        $result = $this->model
            ->where('user_id',$user_id)
            ->where('position', $position)
            ->where('type',1)
            ->first();
            if($result) {
                return $result->update(['position'=> null,'default'=>null]);
            }

            //return $result;
	}
    public function findByVideoposition($user_id,$position) {
        if($image = $this->model->where('user_id',$user_id)->where('type',1)->where('position', 1)->where('default',1)->first()) {
            $arr = ['path'=>$image->path, 'id'=>$image->id];
            return $arr;
        } else {

            $arr = ['path'=>url('assets/app/img/img-11.png'), 'id'=>''];
            return $arr;
            //asset('assets/app/img/service-provider/Frame-408.png')
        }
    }


    /***
     * @updated_by :: Bikash Chhualsingh
     * @date :: 07-July-2023
     *
     * @param $user_id
     * @param $position   => media position
     * @param null $default => default images to be returned or not
     * @return array|mixed
     */
    public function findByposition($user_id,$position, $default = null)
	{
        $conditions = [
            ['user_id', $user_id],
            ['type', 0],
            ['position', $position]
        ];
        if($default !== null) {
            $conditions[] = ['default', '=', $default];
        }
        $defaultThumbImgForPositions = [
            '0' => ['path'=>url('assets/app/img/img-12.png'), 'id'=>''],
            '1' => ['path'=>url('assets/app/img/img-11.png'), 'id'=>''],
            '8' => ['path'=>url('assets/app/img/img-13.png'), 'id'=>''],
            '9' => ['path'=>url('assets/app/img/img-13.png'), 'id'=>''],
            '10' => ['path'=>url('assets/app/img/upload-manage-video.png'), 'id'=>'']
        ];
        switch (in_array($position, ['1', '8', '9', '10'])) {
            case '1':
                $arr = $defaultThumbImgForPositions[$position];
                break;
            default:
                $arr = $defaultThumbImgForPositions[0];
        }

        if($image = $this->model->where($conditions)->first()) {
            $arr = ['path'=>$image->path, 'id'=>$image->id];
        }

		return $arr;
	}
}
