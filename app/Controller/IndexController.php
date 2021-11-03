<?php

declare(strict_types=1);

namespace App\Controller;

use Hrb981027\TreasureBag\Lib\ResponseContent\StandardResponseContent;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return (new StandardResponseContent())->setData([
            'method' => $method,
            'message' => "Hello {$user}.",
        ])->toArray();
    }
}
