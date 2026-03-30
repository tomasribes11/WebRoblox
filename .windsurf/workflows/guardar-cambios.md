---
description: Guardar cambios en Git con commit automático
---

# Workflow para Guardar Cambios en Git

Este workflow te ayuda a guardar todos los cambios en tu repositorio Git de forma sencilla.

## Pasos para guardar cambios:

1. **Revisar cambios pendientes**
   ```powershell
   & "C:\Program Files\Git\bin\git.exe" status
   ```

2. **Agregar todos los cambios al staging area**
   ```powershell
   & "C:\Program Files\Git\bin\git.exe" add .
   ```

3. **Hacer commit con mensaje descriptivo**
   ```powershell
   & "C:\Program Files\Git\bin\git.exe" commit -m "Tu mensaje descriptivo aquí"
   ```

4. **(Opcional) Subir cambios al repositorio remoto**
   ```powershell
   & "C:\Program Files\Git\bin\git.exe" push origin master
   ```

## Comandos útiles adicionales:

- **Ver historial de commits:**
  ```powershell
  & "C:\Program Files\Git\bin\git.exe" log --oneline -10
  ```

- **Ver diferencias antes de commit:**
  ```powershell
  & "C:\Program Files\Git\bin\git.exe" diff --staged
  ```

- **Deshacer último commit (conservando cambios):**
  ```powershell
  & "C:\Program Files\Git\bin\git.exe" reset --soft HEAD~1
  ```

## Buenas prácticas para mensajes de commit:

- Usa mensajes cortos y descriptivos
- Comienza con un verbo en infinitivo: "Añadir", "Corregir", "Actualizar", "Eliminar"
- Separa el título del cuerpo con una línea en blanco si necesitas más detalles

## Ejemplo de uso diario:

Cuando hagas cambios en tus archivos, simplemente ejecuta:
1. `& "C:\Program Files\Git\bin\git.exe" add .`
2. `& "C:\Program Files\Git\bin\git.exe" commit -m "Actualizar página principal"`

¡Tus cambios quedarán guardados en el historial del repositorio!
