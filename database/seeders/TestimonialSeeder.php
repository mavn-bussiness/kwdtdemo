<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing testimonials
        Testimonial::query()->delete();

        $testimonials = [
            [
                'name' => 'Nakalyango Prossy',
                'community' => 'Namayumba Landing Site',
                'quote' => 'KWDT changed my life. Through their training programs, I learned soap making skills and now I can support my family. I\'m proud to be part of this movement.',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Margaret Nakato',
                'community' => 'Katuba, Buikwe',
                'quote' => 'The clean water project brought dignity back to our community. No more walking miles for water. This is real change that KWDT brings.',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'Aisha Sserwanja',
                'community' => 'Kasensero Landing Site',
                'quote' => 'My daughter\'s life changed when we got access to menstrual health products and education. Thank you KWDT for fighting for our daughters.',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'James Kato',
                'community' => 'Ggaba Landing Site',
                'quote' => 'Through KWDT\'s sustainable fisheries training, I learned better fishing methods that earn me more while protecting the lake. Truly transformational.',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'name' => 'Joan Kiprotich',
                'community' => 'Dunga, Kismayu',
                'quote' => 'KWDT recognized that we are not just beneficiaries but partners in development. Their respect for our voices made all the difference.',
                'is_featured' => true,
                'order' => 5,
            ],
            [
                'name' => 'Peter Waweru',
                'community' => 'Homa Bay Region',
                'quote' => 'The organization\'s commitment to sustainable practices has improved both the lake\'s health and our community\'s well-being.',
                'is_featured' => false,
                'order' => 6,
            ],
            [
                'name' => 'Ruth Omondi',
                'community' => 'Entebbe Area',
                'quote' => 'I joined KWDT\'s women\'s cooperative and now earn three times what I used to. Education and support make the real difference.',
                'is_featured' => false,
                'order' => 7,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
