<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Culture;

class CultureSeeder extends Seeder
{
    public function run(): void
    {
        $oudeData = [
            [
                'id' => 'japanese',
                'name' => 'Japanese Culture',
                'emoji' => '🎌',
                'flag' => '/IMG/japan.png',
                'description' => "Explore tea ceremony, festivals, and etiquette from Japan.\n\n✨ Tea ceremony: The Japanese tea ceremony celebrates harmony, respect, purity, and tranquility.\n✨ Cherry blossom: Sakura season is a time for hanami picnics and cultural reflection.\n✨ Traditional crafts: Origami, kimono weaving, and pottery are iconic Japanese arts.",
                'quiz' => [
                    ['question' => 'What is hanami?', 'choices' => ['A tea ritual', 'Cherry blossom viewing', 'New Year festival', 'A martial art'], 'answer' => 1],
                    ['question' => 'Which value is central to the tea ceremony?', 'choices' => ['Strength', 'Wealth', 'Harmony', 'Speed'], 'answer' => 2],
                    ['question' => 'Origami is the art of:', 'choices' => ['Cooking', 'Paper folding', 'Painting', 'Music'], 'answer' => 1],
                    ['question' => 'What is a kimono?', 'choices' => ['A type of food', 'A traditional garment', 'A festival', 'A musical instrument'], 'answer' => 1],
                    ['question' => 'Which season is celebrated with cherry blossoms?', 'choices' => ['Spring', 'Summer', 'Autumn', 'Winter'], 'answer' => 0]
                ]
            ],
            [
                'id' => 'mexican',
                'name' => 'Mexican Culture',
                'emoji' => '🌮',
                'flag' => '/IMG/mexico.png',
                'description' => "Discover Day of Dead, mariachi, street food, and folk art.\n\n✨ Day of the Dead: A joyful celebration honoring ancestors with altars, candles, and marigolds.\n✨ Street food: Tacos, elote, and churros are delicious parts of daily Mexican culture.\n✨ Music: Mariachi and folk songs are vibrant cultural expressions.",
                'quiz' => [
                    ['question' => 'What is Día de los Muertos?', 'choices' => ['A harvest festival', 'A celebration of the dead', 'A wedding ritual', 'A sports event'], 'answer' => 1],
                    ['question' => 'Which flower is commonly used in Day of the Dead altars?', 'choices' => ['Rose', 'Lily', 'Marigold', 'Sunflower'], 'answer' => 2],
                    ['question' => 'Mariachi music often features which instrument?', 'choices' => ['Bagpipes', 'Guitar', 'Violin', 'Flute'], 'answer' => 2],
                    ['question' => 'What is “elote”?', 'choices' => ['A type of taco', 'Grilled corn on the cob', 'A spicy sauce', 'A traditional dance'], 'answer' => 1],
                    ['question' => 'Which of these is a popular Mexican street food?', 'choices' => ['Sushi', 'Churros', 'Pizza', 'Baguette'], 'answer' => 1]
                ]
            ],
            [
                'id' => 'egyptian',
                'name' => 'Egyptian Culture',
                'emoji' => '🕌',
                'flag' => '/IMG/egypt.png',
                'description' => "Learn about ancient myths, Nile festivals, and Egyptian craftsmanship.\n\n✨ Ancient stories: Egyptian culture is shaped by legends of gods, pharaohs, and the Nile.\n✨ Nile life: The river brings food, celebration, and farming rituals to local communities.\n✨ Symbolism: Scarabs, ankhs, and hieroglyphs are powerful cultural symbols.",
                'quiz' => [
                    ['question' => 'What ancient river is central to Egyptian culture?', 'choices' => ['Amazon', 'Nile', 'Yangtze', 'Mississippi'], 'answer' => 1],
                    ['question' => 'What does an ankh symbolize?', 'choices' => ['Strength', 'Beginning', 'Life', 'Wealth'], 'answer' => 2],
                    ['question' => 'Which animal was sacred in ancient Egypt?', 'choices' => ['Cat', 'Horse', 'Eagle', 'Wolf'], 'answer' => 0],
                    ['question' => 'What is a scarab?', 'choices' => ['A type of jewelry', 'A beetle symbolizing rebirth', 'A festival', 'A musical instrument'], 'answer' => 1],
                    ['question' => 'Which of these is an ancient Egyptian god?', 'choices' => ['Zeus', 'Ra', 'Odin', 'Shiva'], 'answer' => 1]
                ]
            ],
            [
                'id' => 'moroccan',
                'name' => 'Moroccan Culture',
                'emoji' => '🕌',
                'flag' => '/IMG/morocco.png',
                'description' => "Experience souks, mint tea rituals, vibrant crafts, and shared meals.\n\n✨ Mint tea ritual: Serving mint tea is a warm sign of hospitality and friendship in Morocco.\n✨ Souk markets: Traditional markets are full of spices, carpets, lanterns, and local stories.\n✨ Moroccan cuisine: Couscous, tagines, and pastries bring together family flavors and spices.",
                'quiz' => [
                    ['question' => 'What is a key ingredient in Moroccan mint tea?', 'choices' => ['Basil', 'Rosemary', 'Mint', 'Sage'], 'answer' => 2],
                    ['question' => 'What is a “souk”?', 'choices' => ['A spice blend', 'A market', 'A dance', 'A festival'], 'answer' => 1],
                    ['question' => 'Which dish is Moroccan?', 'choices' => ['Sushi', 'Tagine', 'Goulash', 'Paella'], 'answer' => 1],
                    ['question' => 'What is a common feature of Moroccan crafts?', 'choices' => ['Minimalism', 'Bright colors and intricate patterns', 'Monochrome designs', 'Abstract shapes'], 'answer' => 1],
                    ['question' => 'Which of these is a traditional Moroccan pastry?', 'choices' => ['Baklava', 'Croissant', 'Macaron', 'Doughnut'], 'answer' => 0]
                ]
            ],
            [
                'id' => 'turkish',
                'name' => 'Turkish Culture',
                'emoji' => '🧿',
                'flag' => '/IMG/turkiye.png',
                'description' => "Explore bazaars, tea gardens, storytelling, and centuries of Anatolian heritage.\n\n✨ Tea gardens: Turkish tea is a daily ritual shared in tulip-shaped glasses at tea gardens.\n✨ Bazaars: Grand Bazaar and spice markets are lively hubs of commerce and conversation.\n✨ Cultural art: Iznik tiles, calligraphy, and carpets reflect Turkey’s layered history.",
                'quiz' => [
                    ['question' => 'What glass shape is traditional for Turkish tea?', 'choices' => ['Square', 'Tulip-shaped', 'Cylinder', 'Bowl'], 'answer' => 1],
                    ['question' => 'What is the Grand Bazaar?', 'choices' => ['A palace', 'A market', 'A mosque', 'A festival'], 'answer' => 1],
                    ['question' => 'Which craft is Turkey famous for?', 'choices' => ['Origami', 'Iznik tiles', 'Pottery', 'Kilim weaving'], 'answer' => 1],
                    ['question' => 'What is a common theme in Turkish art?', 'choices' => ['Nature and geometry', 'Abstract expressionism', 'Minimalism', 'Pop culture'], 'answer' => 0],
                    ['question' => 'Which of these is a traditional Turkish dish?', 'choices' => ['Sushi', 'Kebab', 'Pizza', 'Taco'], 'answer' => 1]
                ]
            ],
            [
                'id' => 'chinese',
                'name' => 'Chinese Culture',
                'emoji' => '🐉',
                'flag' => '/IMG/china.png',
                'description' => "Discover festivals, calligraphy, tea culture, and ancient traditions from China.\n\n✨ Festivals: Chinese New Year and Mid-Autumn Festival are full of lanterns, family, and ritual.\n✨ Tea culture: Tea has been enjoyed for centuries, from green tea to oolong ceremonies.\n✨ Symbols: Dragons, red lanterns, and calligraphy carry deep meanings of luck and harmony.",
                'quiz' => [
                    ['question' => 'Which festival uses red lanterns and dragon dances?', 'choices' => ['Diwali', 'Chinese New Year', 'Carnival', 'Hanami'], 'answer' => 1],
                    ['question' => 'What drink is central to Chinese culture?', 'choices' => ['Coffee', 'Tea', 'Soda', 'Wine'], 'answer' => 1],
                    ['question' => 'What does the dragon often symbolize?', 'choices' => ['Luck and power', 'Sadness', 'Silence', 'Speed'], 'answer' => 0],
                    ['question' => 'Which of these is a traditional Chinese art form?', 'choices' => ['Calligraphy', 'Origami', 'Mosaic', 'Graffiti'], 'answer' => 0],
                    ['question' => 'What is a common theme in Chinese festivals?', 'choices' => ['Family and renewal', 'Individual achievement', 'Sports and competition', 'Technology and innovation'], 'answer' => 0]
                ]
            ],
            [
                'id' => 'indian',
                'name' => 'Indian Culture',
                'emoji' => '🪔',
                'flag' => '/IMG/india.png',
                'description' => "Learn about festivals, spices, dance, and the rich tapestry of Indian life.\n\n✨ Festivals: Diwali, Holi, and many regional festivals bring color, food, and family together.\n✨ Cuisine: Spices, street food, and vegetarian dishes are celebrated across India.\n✨ Performing arts: Classical dance, Bollywood music, and storytelling are key cultural forms.",
                'quiz' => [
                    ['question' => 'Which celebration uses colored powder and joy?', 'choices' => ['Diwali', 'Holi', 'Ramadan', 'Carnival'], 'answer' => 1],
                    ['question' => 'What is a common element in Indian cooking?', 'choices' => ['Chili spices', 'Tortillas', 'Soy sauce', 'Wasabi'], 'answer' => 0],
                    ['question' => 'Which Indian dance style is classical?', 'choices' => ['Tango', 'Kathak', 'Salsa', 'Hip hop'], 'answer' => 1],
                    ['question' => 'What is a common theme in Indian festivals?', 'choices' => ['Family and spirituality', 'Individual achievement', 'Sports and competition', 'Technology and innovation'], 'answer' => 0],
                    ['question' => 'Which of these is a popular Indian street food?', 'choices' => ['Samosa', 'Pizza', 'Taco', 'Baguette'], 'answer' => 0]
                ]
            ],
            [
                'id' => 'norwegian',
                'name' => 'Norwegian Culture',
                'emoji' => '❄️',
                'flag' => '/IMG/norway.png',
                'description' => "Explore fjords, Viking history, winter traditions, and coastal cuisine of Norway.\n\n✨ Fjords: Norwegian fjords are dramatic landscapes that shape local fishing and outdoor life.\n✨ Viking heritage: Viking stories and rune history remain part of Norway’s cultural identity.\n✨ Hygge and outdoors: Friluftsliv celebrates outdoor living and cozy time with family in nature.",
                'quiz' => [
                    ['question' => 'What is a fjord?', 'choices' => ['A traditional hut', 'A narrow coastal inlet', 'A festival', 'A folk dance'], 'answer' => 1],
                    ['question' => 'What is “friluftsliv” about?', 'choices' => ['Indoor cooking', 'Outdoor life', 'A winter sport', 'A folk song'], 'answer' => 1],
                    ['question' => 'Which historical group is associated with Norway?', 'choices' => ['Samurai', 'Vikings', 'Incas', 'Mongols'], 'answer' => 1],
                    ['question' => 'What is a common theme in Norwegian culture?', 'choices' => ['Family and nature', 'Individual achievement', 'Sports and competition', 'Technology and innovation'], 'answer' => 0],
                    ['question' => 'Which of these is a traditional Norwegian dish?', 'choices' => ['Sushi', 'Lutefisk', 'Pizza', 'Taco'], 'answer' => 1]
                ]
            ]
        ];

        foreach ($oudeData as $data) {
            $culture = Culture::updateOrCreate(
                ['id' => $data['id']],
                [
                    'name' => $data['name'],
                    'emoji' => $data['emoji'],
                    'flag_path' => $data['flag'],
                    'description' => $data['description'],
                ]
            );
            $culture->questions()->delete();

            foreach ($data['quiz'] as $vraagData) {
                $question = $culture->questions()->create([
                    'question_text' => $vraagData['question']
                ]);

                foreach ($vraagData['choices'] as $index => $choice) {
                    $question->answers()->create([
                        'answer_text' => $choice,
                        'is_correct' => ($index === $vraagData['answer']) 
                    ]);
                }
            }
        }
    }
}