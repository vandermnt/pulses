<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionModel;
use App\DimensionModel;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller {

  public function index() {
    $questions = DB::table('question')
    ->leftJoin('dimension', 'question.id_dimension', 'dimension.id')
    ->select('question.id',
    'question.text_question',
    'dimension.dimension',
    'question.id_dimension',
    'question.status'
    )
    ->get();
    $dimensions = DimensionModel::all();

    return response()->json([
      "questions" => $questions,
      "dimensions" => $dimensions
    ], 200);
  }

  public function save(Request $request) {
    $text_question = $request->input('text_question');
    $dimension = $request->input('dimension');

    $question = new QuestionModel();

    try {

      $question->text_question = $text_question;
      $question->status = 1;
      $question->id_dimension = $dimension;
      $question->save();

      return response()->json([
        "success" => "Pergunta salva com sucesso!"
      ], 200);

    } catch (\Throwable $error) {
      return response()->json([
        "error" => "Erro ao salvar a pergunta " . $error
      ], 500);
    }
  }

  public function update(Request $request) {
    $id_question = $request->input('id_question');
    $text_question = $request->input('text_question');
    $dimension = $request->input('id_dimension');

    $question = QuestionModel::find($id_question);

    if ($question) {
      try {
        $question->text_question = $text_question;
        $question->id_dimension = $dimension;

        $question->save();

        return response()->json([
          "success" => "Pergunta editada com sucesso!"
        ], 200);
      } catch (\Throwable $error) {
        return response()->json([
          "error" => "Erro ao editar a pergunta",
          $error
        ], 500);
      }
    }

    return response()->json([
      "Object not found"
    ], 200);
  }

  public function delete($id) {
    $question = QuestionModel::find($id);

    if ($question) {
      try {
        $question->delete();

        $questions = DB::table('question')
        ->leftJoin('dimension', 'question.id_dimension', 'dimension.id')
        ->select('question.id',
        'question.text_question',
        'dimension.dimension',
        'question.id_dimension',
        'question.status'
        )
        ->get();

        return response()->json([
          "success" => "Pergunta excluída com sucesso!",
          "questions" => $questions
        ], 200);
      } catch (\Throwable $error) {
        return response()->json([
          "error" => "Erro ao excluir a pergunta!",
          $error
        ], 500);
      }
    }
    return response()->json([
      "Object not found"
    ], 200);
  }

  public function updateStatus(Request $request) {
    $status = $request->input('status');
    $id_question = $request->input('id');

    $question = QuestionModel::find($id_question);

    if($question) {
      try {
        $question->status = $status;
        $question->save();

        return response()->json([
          "success" => "Status alterado com sucesso!"
        ], 200);
      } catch (\Throwable $error) {
        return response()->json([
          "error" => "Erro ao alterar status",
          $error
        ], 500);
      }
    }
  }
}
