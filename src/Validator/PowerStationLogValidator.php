<?php

namespace App\Validator;

use App\Document\PowerStationLog;
use Symfony\Component\HttpFoundation\Request;

class PowerStationLogValidator
{
    private Request $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }
    public function validate()
    {
        $data = $this->request->toArray();
        if (! isset($data['measurement']) || is_null($data['measurement'])) {
            throw new \Exception('Field measurement is required');
        }

        if (! is_int($data['measurement']['powerStationId'])) {
            throw new \Exception('Vhe value of the powerStationId field is not valid. Must be integer.');
        }

        if (! is_float($data['measurement']['currentPower'])) {
            throw new \Exception('Vhe value of the currentPower field is not valid. Must be float.');
        }

        if (! \DateTime::createFromFormat(PowerStationLog::DATE_TIME_FORMAT, $data['measurement']['measurementTime'])) {
            throw new \Exception('Vhe value of the measurementTime field is not valid. Correct format: ' . PowerStationLog::DATE_TIME_FORMAT);
        }
    }
}
