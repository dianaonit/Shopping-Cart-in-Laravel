<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product =new \App\Product([
            'imagePath' => 'http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 10
        ]); 
        $product->save();

        $product =new \App\Product([
            'imagePath' => 'https://i3.books-express.ro/bf/9781645173489/world-of-warcraft-rise-of-the-horde-lord-of-the-clans.jpg',
            'title' => 'WorCraft',
            'description' => 'Enter the fantastical world of the Alliance and the Horde with these two World of Warcraft stories by Christie Golden. Learn about the Orc Thrall’s rise to power in Lord of the Clans, and then follow him through the history of how the Horde came to be in Rise of the Horde. This beautifully bound book is a must-have for any World of Warcraft fan and will be a treasured addition to any gaming library.',
            'price' => 25
        ]); 
        $product->save();

        $product =new \App\Product([
            'imagePath' => 'https://i3.books-express.ro/bf/9780008255183/snow-on-the-cobbles.jpg',
            'title' => 'Snow on the Cobbles',
            'description' => 'The prefect seasonal gift full of nostalgia and charm, perfect for fans of Coronation Street and readers who love Fiction set in times past.',
            'price' => 20
        ]); 
        $product->save();

        $product =new \App\Product([
            'imagePath' => 'https://i0.books-express.ro/bf/9780008378455/deedes-l-the-little-book-of-marmalade.jpg',
            'title' => 'The Little Book of Marmalade',
            'description' => 'A perfect guide to making marmalade from the award-winning Lucy Deedes.',
            'price' => 15
        ]); 
        $product->save();

        $product =new \App\Product([
            'imagePath' => 'https://i0.books-express.ro/bf/9781529124651/light-of-the-jedi.jpg',
            'title' => 'Light of the Jedi',
            'description' => 'As the sky breaks open and destruction rains down upon the peaceful alliance they helped to build, the Jedi must trust in the Force to see them through a day in which a single mistake could cost billions of lives. Even as the Jedi battle valiantly against calamity, something truly deadly grows beyond the boundary of the Republic.',
            'price' => 10
        ]); 
        $product->save();

        $product =new \App\Product([
            'imagePath' => 'https://i3.books-express.ro/bf/9780008149086/the-cutting-place-maeve-kerrigan-book-9.jpg',
            'title' => 'The Cutting Place',
            'description' => 'The gripping new thriller from the Top Ten Sunday Times bestselling author, shortlisted for the Irish Crime Book Awards 2020 You ve got to be in the club to know the truth.
            Everyone s heard the rumours about elite gentlemens clubs, where the champagne flows freely, the parties are the height of decadence ..and the secrets are darker than you could possibly imagine.',
            'price' => 10
        ]); 
        $product->save();

       
    }
}
