<?

/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 08/11/14
 * Time: 23:42
 * @property mixed location
 * @property mixed wind
 * @property mixed weatherstations
 * @property mixed weathericon
 * @property mixed city
 * @property mixed country
 * @property mixed satellite
 * @property mixed temperature
 */
class Weather
{
    /**
     * @var array|mixed
     */
    private $parsed_json_condtition;
    /**
     * @var array|mixed
     */
    private $parsed_json_geolookup;
    /**
     * @var
     */
    private $apikey;

    /**
     * @param $lat
     * @param $long
     * @param $apikey
     */
    public function __construct($lat, $long, $apikey)
    {
        $this->apikey = $apikey;

        $this->parsed_json_condtition = $this->curl(
            $this->url('conditions', $lat, $long));

        $this->parsed_json_geolookup = $this->curl(
            $this->url('geolookup', $lat, $long));
    }

    /**
     * @param $url
     * @param bool $image
     * @return array|mixed
     */
    private function curl($url, $image = false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($ch);

        if ($image) {
            $info = curl_getinfo($ch);

            $values = [
                0 => $data,
                1 => $info
            ];

            return $values;
        }

        return $data;
    }

    /**
     * @param $search
     * @param $lat
     * @param $long
     * @return string
     */
    private function url($search, $lat, $long)
    {
        return 'http://api.wxug.com/api/' . $this->apikey . '/' . $search . '/q/' . $lat . ',' . $long . '.json';
    }

    /**
     * @param $name
     * @return array
     */
    public function __get($name)
    {
        switch ($name) {
            case 'country':
                return $this->getCountry();

            case 'city':
                return $this->getCity();

            case 'location':
                return $this->getLocation();

            case 'temperature':
                return $this->getTemperature();

            case 'wind':
                return $this->getWind();

            case 'weathericon':
                return $this->getWeatherIcon();

            case 'satellite':
                return $this->getSatelliteImage();

            case 'weatherstations':
                return $this->getWeatherStations();
        }
        return 'Not valid';
    }

    /**
     * @return mixed
     */
    private function getCountry()
    {
        $data = json_decode($this->parsed_json_geolookup);
        return $data->{'location'}->{'country_name'};
    }

    /**
     * @return mixed
     */
    private function getCity()
    {
        $data = json_decode($this->parsed_json_geolookup);
        return $data->{'location'}->{'city'};
    }

    /**
     * @return array
     */
    private function getLocation()
    {
        $data = json_decode($this->parsed_json_geolookup);
        $values = [
            0 => $data->{'location'}->{'lat'},
            1 => $data->{'location'}->{'lon'}
        ];
        return $values;
    }

    /**
     * @return array
     */
    private function getTemperature()
    {
        $data = json_decode($this->parsed_json_condtition);
        $values = [
            0 => $data->{'current_observation'}->{'temp_c'},
            1 => $data->{'current_observation'}->{'temp_f'},
            2 => $data->{'current_observation'}->{'feelslike_c'},
            3 => $data->{'current_observation'}->{'feelslike_f'}
        ];
        return $values;
    }

    /**
     * @return array
     */
    private function getWind()
    {
        $data = json_decode($this->parsed_json_condtition);
        $values = [
            0 => $data->{'current_observation'}->{'wind_kph'},
            1 => $data->{'current_observation'}->{'wind_mph'},
            2 => $data->{'current_observation'}->{'wind_dir'},
            3 => $data->{'current_observation'}->{'wind_degrees'}
        ];
        return $values;
    }

    /**
     * @return mixed
     */
    private function getWeatherIcon()
    {
        $data = json_decode($this->parsed_json_condtition);
        return $data->{'current_observation'}->{'icon_url'};
    }

    /**
     * @return array
     */
    private function getSatelliteImage()
    {
        $location = $this->getLocation();
        $curl = $this->curl('http://api.wxug.com/api/' . $this->apikey . '/satellite/image.gif?lat=' . $location[0] . '&lon=' . $location[1] . '&radius=100&width=200&height=200&key=sat_ir4_bottom&basemap=1', true);

        $values = [
            0 => $curl[1]['content_type'],
            1 => base64_encode($curl[0])
        ];
        return $values;
    }

    /**
     * @return mixed
     */
    private function getWeatherStations()
    {
        $data = json_decode($this->parsed_json_geolookup);
        $stations = $data->{'location'}->{'nearby_weather_stations'}->{'pws'}->{'station'};
        return $stations;
    }
}