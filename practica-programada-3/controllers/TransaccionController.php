<?php
require_once 'models/Transaccion.php';

class TransaccionController {
    public $transacciones = [];

    public function registrarTransaccion($id, $descripcion, $monto) {
        $nueva = new Transaccion($id, $descripcion, $monto);
        $this->transacciones[] = $nueva;
    }

    public function generarEstadoDeCuenta() {
        $total = 0;
        foreach ($this->transacciones as $t) {
            $total += $t->monto;
        }

        $interes = $total * 0.026;
        $totalConInteres = $total + $interes;
        $cashback = $total * 0.001;
        $final = $totalConInteres - $cashback;

        // Guardar en archivo
        $contenido = "ESTADO DE CUENTA\n\n";
        foreach ($this->transacciones as $t) {
            $contenido .= "ID: $t->id | $t->descripcion | ₡" . number_format($t->monto, 2) . "\n";
        }
        $contenido .= "\nTotal de contado: ₡" . number_format($total, 2);
        $contenido .= "\nIntereses (2.6%): ₡" . number_format($interes, 2);
        $contenido .= "\nCashback (0.1%): ₡" . number_format($cashback, 2);
        $contenido .= "\nMonto final a pagar: ₡" . number_format($final, 2);

        file_put_contents("estado_cuenta.txt", $contenido . "\n\n", FILE_APPEND);

        return [
            'transacciones' => $this->transacciones,
            'contado' => $total,
            'interes' => $interes,
            'cashback' => $cashback,
            'final' => $final
        ];
    }
}
