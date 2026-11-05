<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habits = [
            "Acordar cedo",
            "Manter uma rotina matinal",
            "Praticar gratidão",
            "Evitar procrastinação",
            "Definir metas diárias",
            "Beber bastante água",
            "Praticar exercícios físicos",
            "Dormir bem",
            "Comer de forma equilibrada",
            "Fazer pausas durante o trabalho",
            "Ler todos os dias",
            "Aprender algo novo",
            "Escrever um diário",
            "Evitar consumo excessivo de redes sociais",
            "Ter um mentor ou buscar referências inspiradoras",
            "Manter a organização",
            "Chegar pontualmente",
            "Priorizar tarefas importantes",
            "Melhorar habilidades de comunicação",
            "Buscar feedback constantemente",
            "Economizar regularmente",
            "Evitar dívidas desnecessárias",
            "Criar um orçamento mensal",
            "Investir no próprio futuro",
            "Fazer renda extra",
            "Manter contato com a família e amigos",
            "Ser gentil e empático",
            "Evitar fofocas e negatividade",
            "Desenvolver inteligência emocional",
            "Ajudar os outros sempre que possível",
            "Praticar meditação ou oração",
            "Aceitar e aprender com os erros",
            "Manter uma mentalidade positiva",
            "Viver o presente",
            "Ser grato pelas pequenas coisas",
        ];

        return [
            'user_id' => User::factory(),
            'uuid'    => fake()->uuid(),
            'title'   => fake()->randomElement($habits),
        ];
    }
}
