<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $commandes = [
            // Commandes pour Jean Dupont (Boulangerie du Coin) - stand_id 1
            [
                'stand_id' => 1,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Baguette Tradition', 'quantite' => 2],
                    ['nom' => 'Croissant au Beurre', 'quantite' => 4]
                ]]),
                'date_commande' => Carbon::now()->subDays(5),
            ],
            [
                'stand_id' => 1,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Pain aux Céréales', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now()->subDays(2),
            ],

            // Commandes pour Maria Rossi (Pizza Bella) - stand_id 2
            [
                'stand_id' => 2,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Pizza Margherita', 'quantite' => 1],
                    ['nom' => 'Pizza Végétarienne', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now()->subDays(6),
            ],
            [
                'stand_id' => 2,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Calzone Classique', 'quantite' => 2],
                    ['nom' => 'Tiramisu Maison', 'quantite' => 2]
                ]]),
                'date_commande' => Carbon::now()->subDays(3),
            ],

            // Commandes pour Karim Ben (Le Traiteur) - stand_id 3
            [
                'stand_id' => 3,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Couscous Royal', 'quantite' => 3]
                ]]),
                'date_commande' => Carbon::now()->subDays(7),
            ],
            [
                'stand_id' => 3,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Tajine de Poulet', 'quantite' => 2]
                ]]),
                'date_commande' => Carbon::now()->subDays(1),
            ],

            // Commandes pour Sophie Martin (Choco Délices) - stand_id 4
            [
                'stand_id' => 4,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Tablette Chocolat Noir', 'quantite' => 5],
                    ['nom' => 'Truffes au Chocolat', 'quantite' => 10]
                ]]),
                'date_commande' => Carbon::now()->subDays(4),
            ],
            [
                'stand_id' => 4,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Bonbons au Caramel Salé', 'quantite' => 3]
                ]]),
                'date_commande' => Carbon::now(),
            ],

            // Commandes pour Luc Boucher (Boucherie Fine) - stand_id 5
            [
                'stand_id' => 5,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Rôti de Bœuf', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now()->subDays(10),
            ],
            [
                'stand_id' => 5,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Saucisson Sec', 'quantite' => 2],
                    ['nom' => 'Magret de Canard', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now()->subDays(2),
            ],
            [
                'stand_id' => 5,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Steak de Bœuf', 'quantite' => 3]
                ]]),
                'date_commande' => Carbon::now()->subDays(1),
            ],

            // Commandes pour Julie Sucre (Pâtisserie Sucrée) - stand_id 6
            [
                'stand_id' => 6,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Éclair au Chocolat', 'quantite' => 6],
                    ['nom' => 'Tarte aux Pommes', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now()->subDays(8),
            ],
            [
                'stand_id' => 6,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Mille-Feuille', 'quantite' => 3]
                ]]),
                'date_commande' => Carbon::now()->subDays(3),
            ],
            [
                'stand_id' => 6,
                'details_commande' => json_encode(['produits' => [
                    ['nom' => 'Macarons Assortis', 'quantite' => 1]
                ]]),
                'date_commande' => Carbon::now(),
            ],
        ];

        foreach ($commandes as &$commande) {
            $commande['created_at'] = $now;
            $commande['updated_at'] = $now;
        }

        DB::table('commandes')->insert($commandes);
    }
}
