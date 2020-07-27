package compiler;

import data.Assignment;
import data.FinishedAssignment;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Compiler {

    public static void compile() {
        Assignment assignment = Assignment.getInstance();
        FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();
        boolean isWindows = System.getProperty("os.name").toLowerCase().startsWith("windows");
        boolean build = true;
        String error = "";
        String cmd = "javac " + finishedAssignment.getAssignment_dir() + "/*.java -d " + finishedAssignment.getAssignment_dir();
        ProcessBuilder processBuilder = new ProcessBuilder();
        if (isWindows) {
            processBuilder.command("cmd.exe", "/c", cmd);
        } else {
            processBuilder.command("bash", "-c", cmd);
        }
        try {
            Process p = processBuilder.start();
            p.waitFor();
            BufferedReader errorReader = new BufferedReader(new InputStreamReader(p.getErrorStream()));

            if (errorReader.ready()) {
                build = false;

            }
        } catch (IOException | InterruptedException e) {
        }

        if (build) {
            finishedAssignment.setCompilation_grade(assignment.getCompilation_grade());
            finishedAssignment.setCompilation_feedback("The code compiled successfully");
        } else {
            finishedAssignment.setCompilation_grade(0);
            finishedAssignment.setCompilation_feedback("The code failed to compile.");
        }
    }
}
