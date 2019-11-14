<?php

declare(strict_types=1);

namespace App\Controllers;

trait HomeModelDataTrait
{
    public function getData(): array
    {
        $pros = [
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
            $this->createPros(
                'Responsive', 
                'desktop',
                'some thing to be said about that'
            ),
        ];

        $projects = [
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
            $this->createProject(
                'MyBlog',
                $this->randImage(),
                'MySelf',
                'an laravel blog to show what i can do as an project',
                ['laravel', 'vueJs', 'MySql', 'typeScript', 'bootstrap 4']
            ),
        ];

        $posts = [];

        foreach (range(0, 5) as $i) {
            $posts[] = $this->createPost(
                'php tutrial',
                $this->randImage(),
                'some long text php is called hypertext preprocessor and it`s very good at such time beecouse it runs most of the web',
                rand(4, 20),
                '2015-5-2 10:25pm',
                ['php', 'tutrials', 'new', 'oop']
            );
        }


        return [$pros, $projects, $posts];
    }

    private function randImage () : string
    {
        $arr = range(1, 8);

        return $arr[rand(0, sizeof($arr)-1)] . '.png';
    }

    private function createPros(
        string $title,
        string $icon,
        string $txt
    ): object {
        return (object) [
            'title' => $title,
            'icon' => $icon,
            'txt' => $txt
        ];
    }

    private function createProject(
        string $title,
        string $img,
        string $client,
        string $info,
        array $tags
    ) : object {
        return (object) [
            'title' => $title,
            'img' => $img,
            'client' => $client,
            'info' => $info,
            'tags' => $tags
        ];
    }

    private function createPost (
        string $title,
        string $img,
        string $info,
        int $commentCount,
        string $date,
        array $cats
    ) {
        return (object) [
            'title' => $title,
            'img' => $img,
            'info' => $info,
            'commentCount' => $commentCount,
            'date' => $date,
            'cats' => $cats
        ];
    }
}
