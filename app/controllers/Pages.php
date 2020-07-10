<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Calendar App',
            'description' => 'Welcome to Calendar schedule app.',
        ];
        $this->view('pages/index', $data);
    }

    public function motivation()
    {
        $quotes = array(
            '“You Learn More From Failure Than From Success. Don’t Let It Stop You. Failure Builds Character.” – Unknown',
            '“If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed. The Vision Pulls You.” – Steve Jobs',
            '“Creativity Is Intelligence Having Fun.” – Albert Einstein',
            '“I’ve missed more than 9,000 shots in my career. I’ve lost almost 300 games. 26 times I’ve been trusted to take the game winning shot and missed. I’ve failed over and over and over again in my life and that is why I succeed.” – Michael Jordan',
            '“Talent wins games, but teamwork wins championships.” – Michael Jordan',
            '“It might not be easy but it’ll be worth it.” – Unknown',
            'The most important thing is to try and inspire people so that they can be great in whatever they want to do.– Kobe Bryant',
            '“Don’t be afraid of failure. This is the way to succeed.” – LeBron James',
            'Whether you come back by page or by the big screen, Hogwarts will always be there to welcome you home. J. K. Rowling',
            'Optimism is the faith that leads to achievement. Nothing can be done without hope and confidence. – Helen Keller',
            'It does not matter how slowly you go as long as you do not stop. – Confucius',
            'Good, better, best. Never let it rest. Til your good is better and your better is best. – St. Jerome',
            '“Sometimes you win, sometimes you learn.” – John C. Maxwell',
            '“Dream as if you’ll live forever, live as if you’ll die today.”– James Dean'
        );

        $index = array_rand($quotes, 1);
        $winner = $quotes[$index];
        $data = [
            'title' => 'Motivation',
            'description' => $winner,
        ];
        $this->view('pages/motivation', $data);
    }
}
