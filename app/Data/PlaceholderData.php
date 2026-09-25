<?php

namespace App\Data;

/**
 * Données placeholders pour la démonstration du frontend AquaSecure
 * Ces données seront remplacées par de vraies données provenant de la base de données
 */
class PlaceholderData
{
    /**
     * Zones du réseau d'eau
     */
    public static function zones(): array
    {
        return [
            [
                'id' => 'z1',
                'name' => 'Tunis Nord',
                'emoji' => '🏛️',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 72,
                'y' => 28,
                'sensors' => 14,
                'consumption' => 3200,
                'quality' => 98,
                'pressure' => 4.2,
                'population' => 45000,
                'lastUpdate' => '2 min',
                'incidents' => 0,
                'flowRate' => 125
            ],
            [
                'id' => 'z2',
                'name' => 'Tunis Sud',
                'emoji' => '🌆',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 65,
                'y' => 22,
                'sensors' => 8,
                'consumption' => 1800,
                'quality' => 97,
                'pressure' => 4.5,
                'population' => 32000,
                'lastUpdate' => '5 min',
                'incidents' => 0,
                'flowRate' => 95
            ],
            [
                'id' => 'z3',
                'name' => 'Ariana',
                'emoji' => '🏘️',
                'color' => '#fbbf24',
                'status' => 'alert',
                'x' => 60,
                'y' => 30,
                'sensors' => 10,
                'consumption' => 2400,
                'quality' => 92,
                'pressure' => 3.1,
                'population' => 38000,
                'lastUpdate' => '1 min',
                'incidents' => 2,
                'flowRate' => 108
            ],
            [
                'id' => 'z4',
                'name' => 'Ben Arous',
                'emoji' => '🏭',
                'color' => '#ef4444',
                'status' => 'critical',
                'x' => 42,
                'y' => 48,
                'sensors' => 12,
                'consumption' => 4100,
                'quality' => 78,
                'pressure' => 2.0,
                'population' => 52000,
                'lastUpdate' => '12 min',
                'incidents' => 5,
                'flowRate' => 87
            ],
            [
                'id' => 'z5',
                'name' => 'Sfax Centre',
                'emoji' => '🏢',
                'color' => '#fbbf24',
                'status' => 'alert',
                'x' => 50,
                'y' => 40,
                'sensors' => 16,
                'consumption' => 5200,
                'quality' => 85,
                'pressure' => 2.8,
                'population' => 68000,
                'lastUpdate' => '3 min',
                'incidents' => 3,
                'flowRate' => 142
            ],
            [
                'id' => 'z6',
                'name' => 'Sfax Sud',
                'emoji' => '🏖️',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 68,
                'y' => 42,
                'sensors' => 9,
                'consumption' => 2900,
                'quality' => 96,
                'pressure' => 4.0,
                'population' => 41000,
                'lastUpdate' => '4 min',
                'incidents' => 0,
                'flowRate' => 118
            ],
            [
                'id' => 'z7',
                'name' => 'Sousse Nord',
                'emoji' => '🌊',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 55,
                'y' => 35,
                'sensors' => 11,
                'consumption' => 3400,
                'quality' => 95,
                'pressure' => 3.8,
                'population' => 47000,
                'lastUpdate' => '6 min',
                'incidents' => 1,
                'flowRate' => 132
            ],
            [
                'id' => 'z8',
                'name' => 'Sousse Sud',
                'emoji' => '🏝️',
                'color' => '#fbbf24',
                'status' => 'alert',
                'x' => 48,
                'y' => 18,
                'sensors' => 13,
                'consumption' => 3800,
                'quality' => 88,
                'pressure' => 2.5,
                'population' => 54000,
                'lastUpdate' => '8 min',
                'incidents' => 2,
                'flowRate' => 115
            ],
            [
                'id' => 'z9',
                'name' => 'Monastir',
                'emoji' => '🕌',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 58,
                'y' => 65,
                'sensors' => 10,
                'consumption' => 3100,
                'quality' => 94,
                'pressure' => 3.6,
                'population' => 39000,
                'lastUpdate' => '7 min',
                'incidents' => 0,
                'flowRate' => 122
            ],
            [
                'id' => 'z10',
                'name' => 'Nabeul',
                'emoji' => '🎨',
                'color' => '#ef4444',
                'status' => 'critical',
                'x' => 52,
                'y' => 72,
                'sensors' => 7,
                'consumption' => 2200,
                'quality' => 72,
                'pressure' => 1.5,
                'population' => 28000,
                'lastUpdate' => '15 min',
                'incidents' => 4,
                'flowRate' => 68
            ],
            [
                'id' => 'z11',
                'name' => 'Bizerte',
                'emoji' => '⚓',
                'color' => '#2dd4bf',
                'status' => 'normal',
                'x' => 62,
                'y' => 12,
                'sensors' => 8,
                'consumption' => 2600,
                'quality' => 97,
                'pressure' => 4.3,
                'population' => 35000,
                'lastUpdate' => '10 min',
                'incidents' => 0,
                'flowRate' => 102
            ],
            [
                'id' => 'z12',
                'name' => 'Gabès',
                'emoji' => '🏜️',
                'color' => '#fbbf24',
                'status' => 'alert',
                'x' => 30,
                'y' => 55,
                'sensors' => 9,
                'consumption' => 3500,
                'quality' => 83,
                'pressure' => 2.2,
                'population' => 43000,
                'lastUpdate' => '11 min',
                'incidents' => 2,
                'flowRate' => 98
            ],
        ];
    }

    /**
     * Statistiques des zones par statut
     */
    public static function zoneStats(): array
    {
        $zones = self::zones();
        return [
            'normal' => count(array_filter($zones, fn($z) => $z['status'] === 'normal')),
            'alert' => count(array_filter($zones, fn($z) => $z['status'] === 'alert')),
            'critical' => count(array_filter($zones, fn($z) => $z['status'] === 'critical')),
        ];
    }

    /**
     * Statistiques globales du système
     */
    public static function stats(): array
    {
        $zones = self::zones();
        return [
            'totalZones' => count($zones),
            'totalSensors' => array_sum(array_column($zones, 'sensors')),
            'activeIncidents' => 8,
            'responseTime' => '2.4h',
            'totalUsers' => 1247,
            'systemUptime' => '99.7%',
        ];
    }

    /**
     * Labels des couleurs par statut
     */
    public static function zoneColors(): array
    {
        return [
            'normal' => '#2dd4bf',
            'alert' => '#fbbf24',
            'critical' => '#ef4444',
        ];
    }

    /**
     * Labels des statuts
     */
    public static function zoneLabels(): array
    {
        return [
            'normal' => 'Normal',
            'alert' => 'Alerte',
            'critical' => 'Critique',
        ];
    }

    /**
     * KPIs pour la landing page
     */
    public static function landingKPIs(): array
    {
        return [
            ['icon' => 'activity', 'value' => '12', 'label' => 'Zones surveillées'],
            ['icon' => 'droplet', 'value' => '38 200', 'label' => 'm³ / jour'],
            ['icon' => 'shield', 'value' => '91%', 'label' => 'Qualité moyenne'],
        ];
    }

    /**
     * Trouver une zone par ID
     */
    public static function findZone(string $id): ?array
    {
        $zones = self::zones();
        $filtered = array_filter($zones, fn($z) => $z['id'] === $id);
        return !empty($filtered) ? array_values($filtered)[0] : null;
    }

    /**
     * Formater un nombre pour l'affichage
     */
    public static function formatNumber(int $number): string
    {
        return number_format($number, 0, ',', ' ');
    }
}
