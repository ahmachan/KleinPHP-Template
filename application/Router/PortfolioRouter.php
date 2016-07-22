<?php
namespace App\Router;

use Klein\Klein;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;


class PortfolioRouter implements IRouter
{

    /**
     * @param Klein $klein
     */
    public function create(Klein $klein)
    {
    	$klein->respond('/?', function (Request $request,Response $response,ServiceProvider $service) {
            /*
    	    $smarty = $service->smarty;
            $file = $service->viewDir . '/index.tpl';
            $smarty->assign($service->smartyParams);
            $smarty->display($file);
            */

             $tpl = new \Template($service->viewDir);
             $tpl->assign($service->smartyParams);
             $tpl->display('index.tpl');
    	});
    	
    	$klein->with('/goods', function () use ($klein) {    	
    		//API入口测试
    		$klein->respond('GET', '/?', function (Request $request,Response $response) {
    			$body ='goods';
    			$response->body($body);
    		});
    		
    		$klein->respond('GET', '/[i:goodsId]/?', function (Request $request,Response $response,ServiceProvider $service) {
    			$base64Crypt=$service->base64Crypt;
    			$goodsId=$request->param("goodsId",0);
    			
    			$arr_assign=[
    					'goodsId'=>$goodsId,
    					'g_title'=>'goods detail-'.$goodsId,
    					'b64Crypt'=>$base64Crypt->render($goodsId),
    					'goodsList'=>$base64Crypt->getGoodsQuery(),
    			];
                        $g='';
            
    			//$smarty = $service->smarty;
    			//$file = $service->viewDir . '/goods-detail.tpl';
    			//$smarty->assign($arr_assign);
    			//$smarty->display($file);

    			$tpl = new \Template($service->viewDir."/");
                        $tpl->set('g_title','goods detail-'.$goodsId);
                        $tpl->set('b64Crypt',$base64Crypt->render($goodsId));
                        $tpl->set('goodsId',$goodsId);
    			$tpl->set('goodsList',$base64Crypt->getGoodsQuery());
    			//$tpl->display('goods-detail.tpl');
                        echo $tpl->fetch('goods-detail.tpl');

    		});
    	});
    	
    	/*
        $klein->respond(function (Request $request, Response $response, ServiceProvider $service) {

            //@var Smarty $smarty
            $smarty = $service->smarty;
            $file = $service->viewDir . '/index.tpl';
            print_r($file);
            $smarty->assign($service->smartyParams);
            $smarty->display($file);
        });
        */
    }
}
