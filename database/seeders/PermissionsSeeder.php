<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Profiles par défaut

        $agent = Role::create(['name' => 'Agent Ouverture Dossier']);
        $responsable = Role::create(['name' => 'Responsable']);
        $caissier = Role::create(['name' => 'Caissier']);
        $manager = Role::create(['name' => 'Manager']);
        $raf = Role::create(['name' => 'Responsable financier']);

        // Permissions de dossier
        $permission = Permission::create(['name'=> 'Voir la liste des dossiers imports']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Voir la liste des dossiers exports']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Créer dossier']);
            $agent->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Modifier dossier']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Supprimer dossier']);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Voir le total des dépenses du dossier']);

        // Permissions de transport interne
        $permission = Permission::create(['name'=> 'Voir la liste des transports internes']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Créer transport interne']);
            $agent->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Modifier transport interne']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Supprimer transport interne']);
            $responsable->givePermissionTo($permission);

        // Permissions de bons de caisse
        $permission = Permission::create(['name'=> 'Voir toute la liste des bons de caisse']);

        $permission = Permission::create(['name'=> 'Créer bons de caisse']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);
            $caissier->givePermissionTo($permission);
            $raf->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Supprimer bons de caisse']);

        $permission = Permission::create(['name'=> 'Annuler bon de caisse']);

        $permission = Permission::create(['name'=> 'Retourner bon de caisse']);
            $responsable->givePermissionTo($permission);
            $caissier->givePermissionTo($permission);
            $raf->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Envoyer bon de caisse au manager']);
            $responsable->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Envoyer bon de caisse au RAF']);

        $permission = Permission::create(['name'=> 'Envoyer bon de caisse à la caisse']);
            $raf->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Payer bon de caisse']);
            $caissier->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Effectuer un ajustement de bon']);
            $caissier->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Clore un bon']);
            $caissier->givePermissionTo($permission);

        $permission = Permission::create(['name'=> 'Attacher un document à un bon de caisse']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);
            $caissier->givePermissionTo($permission);
            $raf->givePermissionTo($permission);
        $permission = Permission::create(['name'=> 'Voir les fichiers joints d\'un bon de caisse']);
            $agent->givePermissionTo($permission);
            $responsable->givePermissionTo($permission);
            $caissier->givePermissionTo($permission);
            $raf->givePermissionTo($permission);

        Permission::create(['name'=> 'Voir le commentaire de validation du manager']);
        Permission::create(['name'=> 'Voir les alertes de doublons de bons de caisse']);
        

        // Permissions de utlisateur
        $permission = Permission::create(['name'=> 'Voir la liste des utlisateurs']);
        $permission = Permission::create(['name'=> 'Créer utlisateur']);
        $permission = Permission::create(['name'=> 'Modifier utlisateur']);
        $permission = Permission::create(['name'=> 'Supprimer utlisateur']);

        // Permissions de client
        $permission = Permission::create(['name'=> 'Voir la liste des clients']);
        $permission = Permission::create(['name'=> 'Créer client']);
        $permission = Permission::create(['name'=> 'Modifier client']);
        $permission = Permission::create(['name'=> 'Supprimer client']);

        // Permissions de profile
        $permission = Permission::create(['name'=> 'Voir la liste des profiles']);
        $permission = Permission::create(['name'=> 'Créer profile']);
        $permission = Permission::create(['name'=> 'Modifier profile']);
        $permission = Permission::create(['name'=> 'Supprimer profile']);

        // Permissions des dépots
        $permission = Permission::create(['name'=> 'Effectuer un dépôt']);
            $caissier->givePermissionTo($permission);


        // Permissions des caisse
        $permission = Permission::create(['name'=> 'Voir l\'état de la caisse']);
            $caissier->givePermissionTo($permission);
            $raf->givePermissionTo($permission);

        // Permissions des véhicules
            Permission::create(['name'=> 'Voir les depenses sur un véhicule']);


        // Permission de feuille minute
            Permission::create(['name'=> 'Etablir la feuille minute']);

        // Permission étape dépôt en douane
            Permission::create(['name'=> 'Enregistrer & déposer dossiers en douane']);
            Permission::create(['name'=> 'Charger le BAE']);
            Permission::create(['name'=> 'Charger les bordereaux de livraison signés']);


    }
}
