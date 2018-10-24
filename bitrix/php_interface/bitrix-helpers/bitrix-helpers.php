<? namespace BH\Frontend;

class BitrixHelper 
{
    /**
     * BitrixHelper constructor.
     */
    public static function init()
    {
        require_once 'classes/CIBlockPropertyCheckbox.php';

        require_once 'classes/Frontend/Frontend.php';
        Frontend::init();

        require_once 'classes/Model/ModelInterface.php';
        require_once 'classes/Model/ModelAbstract.php';
    }
}