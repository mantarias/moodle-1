<?php
/**
 * This class has been auto-generated by PHP-DI.
 */
class CompiledContainer extends DI\CompiledContainer{
    const METHOD_MAPPING = array (
  'core\\router\\route_loader_interface' => 'get1',
  'core\\router\\response_validator_interface' => 'get2',
  'core\\router\\request_validator_interface' => 'get3',
  'core_string_manager' => 'get4',
  'core\\clock' => 'get5',
  'Psr\\Clock\\ClockInterface' => 'get6',
  'core\\router\\route_loader' => 'get7',
  'core\\router\\response_validator' => 'get8',
  'core\\router\\request_validator' => 'get9',
);

    protected function get1()
    {
        return $this->delegateContainer->get('core\\router\\route_loader');
    }

    protected function get2()
    {
        return $this->delegateContainer->get('core\\router\\response_validator');
    }

    protected function get3()
    {
        return $this->delegateContainer->get('core\\router\\request_validator');
    }

    protected function get4()
    {
        return $this->resolveFactory(static fn() => get_string_manager(), 'core_string_manager');
    }

    protected function get5()
    {
        return $this->resolveFactory(static fn() => new \core\system_clock(), 'core\\clock');
    }

    protected function get6()
    {
        return $this->delegateContainer->get('core\\clock');
    }

    protected function get7()
    {
        $object = new core\router\route_loader();
        return $object;
    }

    protected function get8()
    {
        $object = new core\router\response_validator();
        return $object;
    }

    protected function get9()
    {
        $object = new core\router\request_validator();
        return $object;
    }

}