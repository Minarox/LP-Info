<?php


namespace App\Controllers;


use App\Core\System\Controller;
use App\Models\DocumentationModel;
use JBBCode\DefaultCodeDefinitionSet;
use JBBCode\Parser;

final class HelpController extends Controller
{
    public function index()
    {
        if (isset($_POST['documentation'])) {
            $new_documentation = new DocumentationModel();
            $new_documentation->setContent($_POST['documentation'])
                ->create();
        }

        $documentations = new DocumentationModel();
        $documentations = $documentations->findAll();

        require_once dirname(__DIR__) . '/Core/Classes/lib/JBBCode/Parser.php';
        require_once dirname(__DIR__) . '/Core/Classes/lib/JBBCode/DefaultCodeDefinitionSet.php';

        $parser = new Parser();
        $parser->addCodeDefinitionSet(new DefaultCodeDefinitionSET());

        $data = [];

        foreach ($documentations as $documentation) {
            $data[] = $parser->parse($documentation->getContent());
        }

        $this->render(name_file: 'other/help', params: [
            'documentations'=> $data
        ], title: 'Documentation');
    }
}