package dynamicTest;

import data.Assignment;
import data.FinishedAssignment;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.util.ArrayList;

public class DynamicTest {
 
    public static void check() {

        Assignment assignment = Assignment.getInstance();
        FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();
        ArrayList<String> dynamic_test_feedback_arr = new ArrayList<String>();

        String line = null;
        int i;
        float trueAnswer = 0;
        for (i = 0; i < assignment.getDynamic_tests().size(); i++) {
            String runOutput = "";
            try {

                String x = "java -cp " + finishedAssignment.getAssignment_dir() + " " + finishedAssignment.getPackage_name() + finishedAssignment.getAssignment_main().replace(".java", "");
                Process pro2 = Runtime.getRuntime().exec(x);
                BufferedWriter out = new BufferedWriter(new OutputStreamWriter(pro2.getOutputStream()));
                out.write(assignment.getDynamic_tests().get(i).getInput());
                out.flush();
                out.close();

                BufferedReader in = new BufferedReader(
                        new InputStreamReader(pro2.getInputStream()));
                while ((line = in.readLine()) != null) {
                    runOutput += line;
                }
                pro2.waitFor();
                if (runOutput.equals(assignment.getDynamic_tests().get(i).getOutput())) {
                    dynamic_test_feedback_arr.add("true");
                    trueAnswer++;
                } else {
                    dynamic_test_feedback_arr.add("false");
                }
                dynamic_test_feedback_arr.add("Test Case " + (i + 1));
                if (assignment.getDynamic_tests().get(i).isHidden()) {
                    dynamic_test_feedback_arr.add("This input is hidden");
                    dynamic_test_feedback_arr.add("This output is hidden");
                } else {
                    dynamic_test_feedback_arr.add(assignment.getDynamic_tests().get(i).getInput());
                    dynamic_test_feedback_arr.add(assignment.getDynamic_tests().get(i).getOutput());
                }
                dynamic_test_feedback_arr.add(runOutput);
            } catch (IOException | InterruptedException ex) {

            }
        }
        finishedAssignment.setDynamic_test_feedback(String.join("#|#|#|#", dynamic_test_feedback_arr));
        finishedAssignment.setDynamic_test_grade(Math.round((trueAnswer / i) * assignment.getDynamic_test_grade()));
    }
}
