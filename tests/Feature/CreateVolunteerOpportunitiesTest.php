<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use RolesTableSeeder;
use App\Models\VolunteerOpportunity;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\VolunteerOpportunityController
 */
class CreateVolunteerOpportunitiesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $user;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $organization;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $volunteer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesTableSeeder::class);

        $this->user = factory(User::class)->create(['role_id' => Role::whereName('volunteer')->first()->id]);
    }

    /** @test */
    public function guests_can_not_view_the_form_to_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->get(route('opportunity.create'));
    }

    /** @test */
    public function volunteers_can_not_view_the_form_to_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->get(route('opportunity.create'));
    }

    /** @test */
    public function organizations_can_view_the_form_to_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->user->update(['role_id' => Role::whereName('organization')->first()->id]);

        $this->actingAs($this->user);

        $this->get(route('opportunity.create'))
            ->assertViewIs('opportunity.create')
            ->assertViewHas('categories');
    }

    /** @test */
    public function guests_can_not_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->post(route('opportunity.store'));
    }

    /** @test */
    public function volunteers_can_not_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthorizationException::class);

        $this->actingAs($this->user);

        $this->post(route('opportunity.store'));
    }

    /** @test */
    public function organizations_can_create_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $this->user->update(['role_id' => Role::whereName('organization')->first()->id]);

        $this->actingAs($this->user);

        $opportunity = factory(VolunteerOpportunity::class)->raw();

        $this->post(route('opportunity.store'), $opportunity)
            ->assertSessionHas('message.type', 'success');

        $this->assertDatabaseHas('volunteer_opportunities', [
            'user_id'            => $this->user->id,
            'category_id'        => $opportunity['category_id'],
            'title'              => $opportunity['title'],
            'description'        => $opportunity['description'],
            'requirements'       => json_encode($opportunity['requirements']),
            'min_hours_per_week' => $opportunity['min_hours_per_week'],
            'max_hours_per_week' => $opportunity['max_hours_per_week'],
            'duration'           => $opportunity['duration'],
        ]);
    }
}
