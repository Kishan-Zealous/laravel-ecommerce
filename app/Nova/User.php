<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Acme\Analytics\Analytics;
use Laravel\Nova\Fields\Text;
use App\Nova\Metrics\NewUsers;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Select;
use User\Profilepic\Profilepic;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Heading;
use Acme\ColorPicker\ColorPicker;
use App\Nova\Metrics\NewReleases;
use App\Nova\Metrics\UsersPerDay;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use App\Nova\Metrics\CountNewUser;
use App\Nova\Metrics\UsersPerPlan;
use Laravel\Nova\Fields\BelongsToMany;
use Acme\StripeInspector\StripeInspector;
use Chaseconey\ExternalImage\ExternalImage;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasMany as FieldsHasMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];


    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('People');
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [



            Profilepic::make('Name', 'userImage')
                ->withMeta([
                    "imgUrl" => "$this->userImage",
                    "firstname" => "$this->firstname",
                    "lastname" => "$this->lastname"
                ])->onlyOnIndex(),

            Heading::make('<p class="text-danger">* All fields are required.</p>')->asHtml(),
            Text::make('FirstName')
                ->hideFromIndex()
                ->rules('required', 'max:255'),
            Text::make('LastName')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->exceptOnForms()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Select::make('User Type')
                ->options([
                    'superadmin' => 'SuperAdmin',
                    'admin' => 'Admin',
                    'customer' => 'Customer',
                ])->onlyOnForms()
                ->rules('required'),

            FieldsHasMany::make('post'),



        ];
    }



    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new Analytics()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
