<?php namespace Vis\Rating;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Vis\Ratings\Rating;

class RatingController extends Controller
{
    /* add rating
     *
     * @return json
     */
    public function doAddVote()
    {
        $data = Input::get("data");

        $data = $this->replaceData($data);

        $isNotValidation = Rating::isNotValid($data);

        if ($isNotValidation) {
            return $isNotValidation;
        }
        
        if (function_exists('__t')) {
            $message = __t('Вы уже голосовали');
        } else {
            $message = 'Вы уже голосовали';
        }

        if (Rating::isCheckIp($data)) {
            return Response::json(
                array(
                    "status" => "error",
                    "error_messages" => $message
                )
            );
        } else {

            Rating::create($data);

            Rating::doClearCache();

            if (function_exists('__t')) {
                $message = __t('Спасибо. Ваш голос учтен');
            } else {
                $message = 'Спасибо. Ваш голос учтен';
            }

            return Response::json(
                array(
                    "status" => "success",
                    "ok_messages" => $message
                )
            );
        }
    }

    /*
     * replace params before validation and save
     * @param array $data
     *
     * @return array
     */
    private function replaceData($data)
    {
        $data['ip'] = getIp();
        $data['ratingspage_id'] = $data['id'];

        $data['ratingspage_type'] = str_replace("\\", "_", Crypt::decrypt($data['model']));

        $data['rating'] = $data['value'];
        if (Sentinel::check()) {
            $data['user_id'] = Sentinel::getUser()->id;;
        }

        return $data;
    }
}
