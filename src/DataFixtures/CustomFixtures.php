<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class CustomFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        // Bundle to manage file and directories
        $finder = new Finder();
        $finder->files()->in('src/DataFixtures/sql'); // si on veut charger plusieurs fichier sql
        
        // dump ($finder->files());
        $content = "" ;
        $cnx = $manager->getConnection();
        $cnx->beginTransaction();
        
        foreach ($finder as $file){
            
            $content = $file->getContents();
            $cnx->setAutoCommit(false);
            $cnx->exec ($content);
            // dd();
            // $cnx->commit();
            // $manager->flush();
            // $stmt = $cnx->prepare($content);
            // $stmt->execute();    
        }
    
    }

}





