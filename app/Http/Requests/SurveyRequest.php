<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SurveyRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            // 'num_games_play' => (int)$this->num_games_play,
            'num_games_play' => filter_var($this->num_games_play, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_mobile' => filter_var($this->hrs_play_mobile, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_console' => filter_var($this->hrs_play_console, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_pc' => filter_var($this->hrs_play_pc, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_shooter' => filter_var($this->hrs_play_shooter, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_act_adv' => filter_var($this->hrs_play_act_adv, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_sims' => filter_var($this->hrs_play_sims, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_moba' => filter_var($this->hrs_play_moba, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_sports' => filter_var($this->hrs_play_sports, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_racing' => filter_var($this->hrs_play_racing, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_strat' => filter_var($this->hrs_play_strat, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_battle_royal' => filter_var($this->hrs_play_battle_royal, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_puzzle_plat' => filter_var($this->hrs_play_puzzle_plat, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_fighting' => filter_var($this->hrs_play_fighting, FILTER_SANITIZE_NUMBER_INT),
            'hrs_play_board' => filter_var($this->hrs_play_board, FILTER_SANITIZE_NUMBER_INT),
            'is_gamer' => filter_var($this->is_gamer, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::id() == $this->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd($this);
        return [
            'num_games_play' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_mobile' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_console' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_pc' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_shooter' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_act_adv' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_sims' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_moba' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_sports' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_racing' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_strat' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_battle_royal' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_puzzle_plat' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_fighting' => ['required', 'integer', 'min:0', 'max:6'],
            'hrs_play_board' => ['required', 'integer', 'min:0', 'max:6'],
            'is_gamer' => ['required', 'boolean']
        ];
    }
}
