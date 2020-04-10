package compiler;

import api.Assignment;
import api.DoingAssignment;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class CodeCompiler {

    public static void compile() {
        boolean build = true;
        String error = "";
        try {
            Process p = Runtime.getRuntime().exec("javac " + DoingAssignment.getAssignment_dir());
            p.waitFor();
            BufferedReader errorReader = new BufferedReader(new InputStreamReader(p.getErrorStream()));

            if (errorReader.ready()) {
                build = false;
                String line;
                while ((line = errorReader.readLine()) != null) {
                    error += line + "\n";
                }
            }
        } catch (IOException | InterruptedException e) {
        }

        if (build) {
            DoingAssignment.setCompilation_grade(Assignment.getCompilation_grade());
            DoingAssignment.setCompilation_feedback("The code compiled successfully");
        } else {
            DoingAssignment.setCompilation_grade(0);
            DoingAssignment.setCompilation_feedback("The code failed to compile\n" + error);
        }
    }
}
