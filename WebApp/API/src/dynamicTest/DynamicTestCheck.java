package dynamicTest;

import api.Assignment;
import api.DoingAssignment;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.util.ArrayList;

public class DynamicTestCheck {

    private static ArrayList<String> dynamic_test_feedback_arr = new ArrayList<String>();

    public static void check() {

        String line = null;
        File file = new File(DoingAssignment.getAssignment_dir());
        int i;
        float trueAnswer = 0;
        for (i = 0; i < Assignment.getDynamic_test_array().size(); i++) {
            String runOutput = "";
            try {
                Process pro1 = Runtime.getRuntime().exec("javac " + file.getAbsolutePath());
                pro1.waitFor();
                String x = "java -cp " + file.getParent() + " " + file.getName().replace(".java", "");
                Process pro2 = Runtime.getRuntime().exec(x);
                BufferedWriter out = new BufferedWriter(new OutputStreamWriter(pro2.getOutputStream()));
                out.write(Assignment.getDynamic_test_array().get(i).getInput());
                out.flush();
                out.close();

                BufferedReader in = new BufferedReader(
                        new InputStreamReader(pro2.getInputStream()));
                while ((line = in.readLine()) != null) {
                    runOutput += line;
                }
                pro2.waitFor();
                dynamic_test_feedback_arr.add("Test Case " + (i + 1));
                if (runOutput.equals(Assignment.getDynamic_test_array().get(i).getOutput())) {
                    dynamic_test_feedback_arr.add("✔");
                    trueAnswer++;
                } else {
                    dynamic_test_feedback_arr.add("✘");
                }
                if (Assignment.getDynamic_test_array().get(i).isHidden()) {
                    dynamic_test_feedback_arr.add("This input is hidden");
                    dynamic_test_feedback_arr.add("This output is hidden");
                } else {
                    dynamic_test_feedback_arr.add(Assignment.getDynamic_test_array().get(i).getInput());
                    dynamic_test_feedback_arr.add(Assignment.getDynamic_test_array().get(i).getOutput());
                }
                dynamic_test_feedback_arr.add(runOutput);
            } catch (IOException | InterruptedException ex) {

            }
        }
        DoingAssignment.setDynamic_test_feedback(String.join("#|#|#|#", dynamic_test_feedback_arr));
        DoingAssignment.setDynamic_test_grade(Math.round((trueAnswer / i) * Assignment.getDynamic_test_grade()));
    }
}
