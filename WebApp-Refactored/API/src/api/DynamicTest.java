package api;

public class DynamicTest {

    private String input;
    private String output;
    private boolean hidden;

    public DynamicTest(String input, String output, boolean hidden) {
        this.input = input;
        this.output = output;
        this.hidden = hidden;
    }

    /**
     * @return the input
     */
    public String getInput() {
        return input;
    }

    /**
     * @return the output
     */
    public String getOutput() {
        return output;
    }

    /**
     * @return the hidden
     */
    public boolean isHidden() {
        return hidden;
    }

}
