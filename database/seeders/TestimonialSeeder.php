<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::query()->delete();

        $testimonials = [
            [
                'name'        => 'Christine',
                'community'   => 'Silverfish Fisher & Processor, Lake Victoria',
                'quote'       => 'This method is associated with illegal fishing because it requires using smaller boats, which is illegal as the fisheries directives state we should only use the 28 ft. vessels! We need policies that protect both the fish and our livelihoods.',
                'is_featured' => true,
                'order'       => 1,
            ],
            [
                'name'        => 'Teopista',
                'community'   => 'Nangoma Landing Site',
                'quote'       => 'We can no longer afford to send our children to school because we are not working. The silver fish business was our primary source of income. There is also a rise in domestic violence, as men no longer contribute financially to their families.',
                'is_featured' => true,
                'order'       => 2,
            ],
            [
                'name'        => 'Female Participant',
                'community'   => 'Sowe, Mukono District',
                'quote'       => 'Training with the men has given us confidence and an opportunity to freely manage menstruation. For the first time, men in our community are stepping into the conversation — and into the solution.',
                'is_featured' => true,
                'order'       => 3,
            ],
            [
                'name'        => 'Lydia Kateregga',
                'community'   => 'Katosi, Mukono District',
                'quote'       => 'My children are safe from the sexual harassment that takes place when girls go to fetch water late in the evening. That alone is worth more than the money I earn from building rainwater tanks.',
                'is_featured' => true,
                'order'       => 4,
            ],
            [
                'name'        => 'Grace Namutebi',
                'community'   => 'Mpunge Sub-County, Mukono',
                'quote'       => 'When I first joined a KWDT women\'s group I was surviving on UGX 3,000 a day — barely enough to feed my four children. Two years later, I own two dairy cows, have installed a biogas plant, and am training other women in my village on organic farming.',
                'is_featured' => true,
                'order'       => 5,
            ],
            [
                'name'        => 'Harriet Nakyeyune',
                'community'   => 'Buvuma Island District',
                'quote'       => 'The Abavubi app shows me the current market rate per kilogram — 14% higher than what the middleman offered me yesterday. I declined his offer and shipped directly. Digital tools have changed how I do business.',
                'is_featured' => false,
                'order'       => 6,
            ],
            [
                'name'        => 'Catherine Joséphine Nalugga',
                'community'   => 'KWDT Project Officer',
                'quote'       => 'Water is not just a development issue — it is a survival issue. It is the pulse of all Sustainable Development Goals. Fair involvement of rights holders must take precedence over tokenistic inclusivity. Participation without power is not participation.',
                'is_featured' => false,
                'order'       => 7,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
