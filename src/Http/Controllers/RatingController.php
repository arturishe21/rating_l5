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

        if (Rating::isCheckIp($data)) {
            return Response::json(
                array(
                    "status" => "error",
                    "error_messages" => "Вы уже голосовали"
                )
            );
        } else {

            Rating::create($data);

            Rating::doClearCache();

            return Response::json(
                array(
                    "status" => "success",
                    "ok_messages" => "Спасибо. Ваш голос учтен"
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
