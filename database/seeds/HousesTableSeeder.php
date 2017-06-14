<?php

use Illuminate\Database\Seeder;
use App\House;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        House::create([
            'name' => 'Script Serpents',
            'singular' => 'Serpent',
            'description' => 'Vile creatures from the underworld code labyrinth. In the ‘old world’ also referred to as ‘Spaghetti code’. In ‘The Coding Conflict’ they get the job done fast as they rush into enemy territory, leaving an untraceable mess with the use of their extremely powerful PHP functions such as explode() and chop(). World Anarchy is their aspiration, and they seek to array_split() the world into fragments.'
        ]);

        House::create([
            'name' => 'Database Dragons',
            'singular' => 'Dragon',
            'description' => 'Armed with the most vicious of queries, the database dragons leaves no table unjoined in ‘The Coding Conflict’. They do not care about the eternal debate. The database dragons fight for more use of views and triggers. They believe in a world of structure and relationships. Armed with lots of data, normalized and lined up in rows and colums, the Database Dragons are a force to be reckoned with. '
        ]);

        House::create([
            'name' => 'Recursive Ravens',
            'singular' => 'Raven',
            'description' => 'Legend says if you see a Recursive Raven use code, you get trapped into the arms of the endless repeating twilight. Armed with a very powerful language called C#, they were the inititiator of the apocalypse of the Old World, better known as the ‘Stack Overflow’, leaving the Old World flooded with data, and cause the beginning of the new Era, the kingdom of Null. With their gigantic command control called ‘Visual Studio’, they are the current commanders of Null.'
        ]);

        House::create([
            'name' => 'Variable Vikings',
            'singular' => 'Viking',
            'description' => 'As the last remnants of the Old World, these humans still fight for bringing back the world they lost in the big apocalypse better known as the ‘Stack Overflow’. Few humans survived thanks to a powerful exception handler built by the hands of the Variable Vikings. Now they seek revenge. The Variable Vikings are known of using every tool at their disposal, whether this is Javascript, Python, Lua, or the old world ‘legendary languages’ such as C, Cobol, Delphi, Pascal and Basic.'
        ]);

    }
}
