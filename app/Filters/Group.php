<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use \IonAuth\Libraries\IonAuth;
use App\Models\Groups;
use \CodeIgniter\HTTp\URI;
use Config\Routing;


class Group implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $ionAuth = new IonAuth();
        $user_id = $ionAuth->user()->row()->id;

        $groupsModel = new Groups();
        $userGroups = $groupsModel->join('users_groups', 'groups.id=users_groups.group_id', 'inner')->where('user_id', $user_id)->findAll();
        
        
        $routing = new Routing();
        $baseURLSegments = $routing->baseURLsegments;
        $uri = new URI(current_url());

       
        $url = $uri->getSegments();
        $result = array();
        foreach($url as $key => $segment) {
            if($key >= $baseURLSegments) {
                $result[] = $segment;
            }
        }
        $r = service('routes');
        var_dump($r->getRoutes());
        echo "<hr>";
       
        var_dump($result);
        echo "<hr>";
        $routes = service('router');
        $con = $routes->controllerName();
        var_dump($con);
        echo "<hr>";
        $method = $routes->methodName();
        var_dump($method);
        echo "<hr>";
        
        
        

    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
