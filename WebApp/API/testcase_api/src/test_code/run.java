package test_code;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import org.json.simple.JSONObject;

public class run {

    public static void main(String[] args) throws IOException, InterruptedException, Exception {

        String input = args[0];
        String output = args[1];
        File file = new File(args[2]);

        String line = null;
        String runOutput = "";
        String filename = file.getName().replace(".java", "");

        Process pro1 = Runtime.getRuntime().exec("javac " + file.getAbsolutePath());
        pro1.waitFor();
        Process pro2 = Runtime.getRuntime().exec("java -cp " + file.getParent() + " " + filename);
        BufferedWriter out = new BufferedWriter(new OutputStreamWriter(pro2.getOutputStream()));
        out.write(input);
        out.flush();
        out.close();

        BufferedReader in = new BufferedReader(
                new InputStreamReader(pro2.getInputStream()));
        while ((line = in.readLine()) != null) {
            runOutput += line;
        }
        pro2.waitFor();
        JSONObject result = new JSONObject();

        if (runOutput.equals(output)) {
            result.put("TestCase", "true");
            result.put("output", runOutput);
        } else {
            result.put("TestCase", "false");
            result.put("output", runOutput);
        }
        System.out.println(result);
    }
}
