<?php 
namespace App\Services;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TeamService implements TeamServiceInterface
{
    public function createTeam(User $leader, array $data): Team
    {
        return Team::create([
            'name' => $data['name'],
            'leader_id' => $leader->id,
        ]);
    }

    public function addMember(Team $team, User $user)
    {
        // if ($team->hasMaxMembers()) {
        //     throw new \Exception('Team cannot have more than 5 members.');
        // }

        $team->users()->attach($user->id);
    }

    public function removeMember(Team $team, User $user)
    {
        $team->users()->detach($user->id);
    }

    public function deleteTeam(Team $team)
    {
        $team->delete(); 
    }
}
