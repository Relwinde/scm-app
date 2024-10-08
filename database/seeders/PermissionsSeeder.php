<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions de dossier
        Permission::create(['name'=> 'Voir la liste des dossiers imports']);
        Permission::create(['name'=> 'Voir la liste des dossiers exports']);
        Permission::create(['name'=> 'Créer dossier']);
        Permission::create(['name'=> 'Modifier dossier']);
        Permission::create(['name'=> 'Supprimer dossier']);

        // Permissions de transport interne
        Permission::create(['name'=> 'Voir la liste des transports internes']);
        Permission::create(['name'=> 'Créer transport interne']);
        Permission::create(['name'=> 'Modifier transport interne']);
        Permission::create(['name'=> 'Supprimer transport interne']);

        // Permissions de bons de caisse
        Permission::create(['name'=> 'Voir toute la liste des bons de caisse']);
        Permission::create(['name'=> 'Créer bons de caisse']);
        Permission::create(['name'=> 'Modifier bons de caisse']);
        Permission::create(['name'=> 'Supprimer bons de caisse']);
        Permission::create(['name'=> 'Annuler bon de caisse']);
        Permission::create(['name'=> 'Retourner bon de caisse']);
        Permission::create(['name'=> 'Envoyer bon de caisse au manager']);
        // Permission::create(['name'=> 'Envoyer bon de caisse à la comptabilité']);
        Permission::create(['name'=> 'Envoyer bon de caisse au responsable finance']);
        Permission::create(['name'=> 'Envoyer bon de caisse à la caisser']);
        Permission::create(['name'=> 'Payer bon de caisse']);

        // Permissions de utlisateur
        Permission::create(['name'=> 'Voir la liste des utlisateurs']);
        Permission::create(['name'=> 'Créer utlisateur']);
        Permission::create(['name'=> 'Modifier utlisateur']);
        Permission::create(['name'=> 'Supprimer utlisateur']);

        // Permissions de client
        Permission::create(['name'=> 'Voir la liste des clients']);
        Permission::create(['name'=> 'Créer client']);
        Permission::create(['name'=> 'Modifier client']);
        Permission::create(['name'=> 'Supprimer client']);

        // Permissions de profile
        Permission::create(['name'=> 'Voir la liste des profiles']);
        Permission::create(['name'=> 'Créer profile']);
        Permission::create(['name'=> 'Modifier profile']);
        Permission::create(['name'=> 'Supprimer profile']);


    }
}
